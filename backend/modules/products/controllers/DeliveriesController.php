<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use common\models\Delivery;
use common\models\Search\DeliverySearch;

/**
 * DeliveriesController implements the CRUD actions for Delivery model.
 */
class DeliveriesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Delivery::className();
        $this->beanSearchClass = DeliverySearch::className();
        parent::init();
    }

}
