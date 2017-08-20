<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use common\models\PaymentType;
use common\models\Search\PaymentTypeSearch;


/**
 * PaymentTypesController implements the CRUD actions for PaymentType model.
 */
class PaymentTypesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = PaymentType::className();
        $this->beanSearchClass = PaymentTypeSearch::className();
        parent::init();
    }

}
