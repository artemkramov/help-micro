<?php
namespace frontend\models;

use backend\models\Currency;
use backend\models\Product;
use Yii;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * Class SessionBasket
 * @package frontend\models
 */
class SessionBasket extends Model implements IBasket
{
    /**
     * @var array
     */
    public $basketProducts;

    /**
     * @var mixed
     */
    public $owner;

    /**
     * Load products
     */
    public function loadProducts()
    {
        $this->basketProducts = Yii::$app->session->get($this->owner->storageName, []);
    }

    /**
     * @param $hash
     * @return bool
     */
    public function isProductInBasket($hash)
    {
        return isset($this->owner->cache[$hash]);
    }

    /**
     * @param $hash
     * @param $pid
     * @param $price
     * @param $characteristicID
     * @param array $params
     * @param int $count
     * @return array
     */
    public function insertProduct($hash, $pid, $price, $characteristicID, $params = [], $count = 1)
    {
        $this->loadProducts();
        if (!$this->isProductInBasket($hash)) {
            $this->basketProducts[$hash] = [
                'count'             => $count,
                'id_product'        => $pid,
                'price'             => $price,
                'characteristic_id' => $characteristicID,
                'params'            => Json::encode($params),
                'created_at'        => time(),
                'updated_at'        => time()
            ];
        } else {
            if ($count > 0) {
                $this->basketProducts[$hash]['count'] = $count;
                $this->basketProducts[$hash]['price'] = $price;
                $this->basketProducts[$hash]['updated_at'] = time();
            } else {
                unset($this->basketProducts[$hash]);
            }
        }
        Yii::$app->session->set($this->owner->storageName, $this->basketProducts);
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
        $this->loadProducts();
        return array_map(
            function ($item) {
                $item['params'] = Json::decode($item['params']);
                return $item;
            },
            $this->basketProducts
        );
    }

    /**
     * @param $hash
     * @return null
     */
    public function getProductById($hash)
    {
        return ($this->isProductInBasket($hash)) ? $this->basketProducts[$hash] : null;
    }

    /**
     * Clear cart
     */
    public function eraseBasket()
    {
        Yii::$app->session->set($this->owner->storageName, null);
    }

    /**
     * @return int
     */
    public function getBasketCount()
    {
        $this->loadProducts();
        return count($this->basketProducts);
    }

    /**
     * @return int
     */
    public function getBasketTotal()
    {
        $this->loadProducts();
        $total = 0;
        foreach ($this->basketProducts as $bp) {
            $total += $bp['count'];
        }
        return $total;
    }

    /**
     * @param bool $format
     * @return int
     */
    public function getBasketCost($format = false)
    {
        $this->loadProducts();
        $cost = 0;
        foreach ($this->basketProducts as $bp) {
            $product = Product::findOne($bp['id_product']);
            $cost += (double)($product->getPriceTotal($bp['characteristic_id'], $bp['count']));
        }
        if ($format) {
            return Currency::showPrice($cost);
        }
        return Currency::convertFromDefault($cost, Currency::getCurrentCurrency());
    }
}