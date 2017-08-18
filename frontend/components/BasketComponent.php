<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/23/2016
 * Time: 1:16 PM
 */

namespace frontend\components;

use frontend\models\IBasket;
use Yii;
use yii\base\Component;
use frontend\models\DbBasket;
use frontend\models\SessionBasket;
use yii\base\UnknownMethodException;

/**
 * Class BasketComponent
 * @package andreykluev\shopbasket
 */
class BasketComponent extends Component
{

    /**
     * @var string
     */
    public $userClass;

    /**
     * @var string
     */
    public $productClass;

    /**
     * @var string
     */
    public $storageName = 'basket';

    /**
     * @var IBasket
     */
    public $basket;

    /**
     * @var string
     */
    public $mergeMethod = 'max';

    /**
     * @var array
     */
    public $cache = [];

    /**
     * Init basket
     */
    public function init()
    {
        if (Yii::$app->getUser()->isGuest) {
            $this->basket = new SessionBasket();
        } else {
            $this->basket = new DbBasket();
            $this->basket->userID = Yii::$app->user->identity->getId();
        }
        $this->basket->owner = $this;
        if (!is_null(Yii::$app->session->get($this->storageName, null)) && !Yii::$app->getUser()->isGuest) {
            $this->basket->merge();
        }
        $this->cache = $this->basket->getBasketProducts();
    }

    /**
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function __call($name, $params)
    {
        try {
            return parent::__call($name, $params);
        }
        catch (UnknownMethodException $ex) {
            if (method_exists($this->basket, $name)) {
                return call_user_func_array([$this->basket, $name], $params);
            }
            else {
                throw new UnknownMethodException();
            }
        }

    }

}