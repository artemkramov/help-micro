<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use common\models\Order;
use common\models\Search\OrderSearch;
use yii\bootstrap\ActiveForm;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

/**
 * OrdersController implements the CRUD actions for Order model.
 */
class OrdersController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Order::className();
        $this->beanSearchClass = OrderSearch::className();
        parent::init();
    }

}
