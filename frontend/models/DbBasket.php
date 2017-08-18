<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/23/2016
 * Time: 12:49 PM
 */

namespace frontend\models;

use backend\models\Currency;
use backend\models\Product;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\web\HttpException;
use Yii;

/**
 * Class DbBasket
 * @package frontend\models
 *
 * @property string $storage
 * @property integer $user_id
 * @property integer $id_product
 * @property string $product_hash
 * @property float $price
 * @property integer $characteristic_id
 * @property integer $count
 * @property array $params
 * @property integer $created_at
 * @property integer $updated_at
 *
 */
class DbBasket extends ActiveRecord implements IBasket
{
    /**
     * @var array
     */
    public $basketProducts;

    /**
     * @var integer
     */
    public $userID;

    /**
     * @var mixed
     */
    public $owner;

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%user_basket}}';
    }

    /**
     * @param $hash
     * @return bool
     */
    public function isProductInBasket($hash)
    {
        foreach ($this->owner->cache as $item) {
            if ($item['product_hash'] == $hash) return true;
        }
        return false;
    }

    /**
     * @param $hash
     * @param $pid
     * @param $price
     * @param $characteristicID
     * @param array $params
     * @param int $count
     * @return array
     * @throws HttpException
     */
    public function insertProduct($hash, $pid, $price, $characteristicID, $params = [], $count = 1)
    {
        if (!$this->isProductInBasket($hash)) {
            $basketProduct = new DbBasket();
            $basketProduct->user_id = $this->userID;
            $basketProduct->storage = $this->owner->storageName;
            $basketProduct->id_product = $pid;
            $basketProduct->product_hash = $hash;
            $basketProduct->characteristic_id = $characteristicID;
            $basketProduct->price = $price;
            $basketProduct->params = Json::encode($params);
            $basketProduct->created_at = time();
            $basketProduct->updated_at = time();
            $basketProduct->count = $count;
            $basketProduct->save();
        } else {
            $basketProduct = $this->findOne([
                'user_id'      => $this->userID,
                'product_hash' => $hash,
                'storage'      => $this->owner->storageName
            ]);
            if (is_null($basketProduct)) {
                throw new HttpException(404, 'Model not found');
            }
            if ($count > 0) {
                $basketProduct->count = $count;
                $basketProduct->price = $price;
                $basketProduct->save();
            } else {
                $basketProduct->delete();
            }
        }
        $this->owner->cache = $this->getBasketProducts();
        return [
            'global'  => [
                'count' => Yii::$app->formatter->asInteger($this->getBasketCount()),
                'total' => Yii::$app->formatter->asInteger($this->getBasketTotal()),
                'cost'  => Yii::$app->formatter->asCurrency($this->getBasketCost()),
            ],
            'current' => [
                'price' => Yii::$app->formatter->asCurrency($price),
                'count' => $count,
                'cost'  => Yii::$app->formatter->asCurrency($price * $count),
            ],
            'result'  => $this->isProductInBasket($hash)
        ];
    }

    /**
     * @return array
     */
    public function getBasketProducts()
    {
        return array_map(
            function ($item) {
                $item['params'] = Json::decode($item['params']);
                return $item;
            },
            $this->find()
                ->where([
                    'user_id' => $this->userID,
                    'storage' => $this->owner->storageName
                ])
                ->asArray()
                ->all()
        );
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function getProductById($hash)
    {
        return $this->find()
            ->where([
                'user_id'      => $this->userID,
                'product_hash' => $hash
            ])
            ->asArray()
            ->one();
    }

    /**
     * Delete the cart
     */
    public function eraseBasket()
    {
        $this->deleteAll([
            'user_id' => $this->userID,
            'storage' => $this->owner->storageName
        ]);
    }

    /**
     * @return int|string
     */
    public function getBasketCount()
    {
        return $this->find()
            ->where([
                'user_id' => $this->userID,
                'storage' => $this->owner->storageName
            ])
            ->count();
    }

    /**
     * @return int|mixed
     */
    public function getBasketTotal()
    {
        $total = $this->find()
            ->where([
                'user_id' => $this->userID,
                'storage' => $this->owner->storageName
            ])
            ->sum('count');
        return ($total) ? $total : 0;
    }

    /**
     * @param bool $format
     * @return int|mixed
     */
    public function getBasketCost($format = false)
    {
        $this->basketProducts = $this->getBasketProducts();
        $cost = 0;
        foreach ($this->basketProducts as $bp) {
            /**
             * @var Product $product
             */
            $product = Product::findOne($bp['id_product']);
            $cost += (double)($product->getPriceTotal($bp['characteristic_id'], $bp['count']));
        }
        if ($format) {
            return Currency::showPrice($cost);
        }
        return Currency::convertFromDefault($cost, Currency::getCurrentCurrency());
    }

    /**
     * Merge data from session and database
     */
    public function merge()
    {
        $sessionProducts = Yii::$app->session->get($this->owner->storageName, []);
        switch ($this->owner->mergeMethod) {
            case 'sum':
                $this->mergeBasket_sum($sessionProducts);
                break;
            case 'new':
                $this->mergeBasket_new($sessionProducts);
                break;
            case 'max':
                $this->mergeBasket_max($sessionProducts);
                break;
            default:
                $this->mergeBasket_merge($sessionProducts);
        }
        // Очищаем корзину в сессии
        Yii::$app->session->set($this->owner->storageName, null);
    }

    /**
     * @param $sessionProducts
     */
    public function mergeBasket_sum($sessionProducts)
    {
    }

    /**
     * @param $sessionProducts
     */
    public function mergeBasket_new($sessionProducts)
    {
    }

    /**
     * @param $sessionProducts
     */
    public function mergeBasket_merge($sessionProducts)
    {
    }

    /**
     * @param $sessionProducts
     */
    public function mergeBasket_max($sessionProducts)
    {
        $dbProducts = $this->getBasketProducts();
        foreach ($dbProducts as $bItem) {
            if (isset($sessionProducts[$bItem['product_hash']])) {
                if ($bItem['count'] < $sessionProducts[$bItem['product_hash']]['count']) {
                    /**
                     * @todo Нужно обновить кол-во в БД
                     */
                }
                unset($sessionProducts[$bItem['product_hash']]);
            }
        }
        foreach ($sessionProducts as $hash => $bItem) {
            $this->insertProduct($hash, $bItem['id_product'], $bItem['price'], $bItem['characteristic_id'], Json::decode($bItem['params']), $bItem['count']);
        }
    }

}