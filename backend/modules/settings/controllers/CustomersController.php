<?php

namespace backend\modules\settings\controllers;

use backend\controllers\CRUDController;
use common\models\Customer;
use common\models\Search\CustomerSearch;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomersController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Customer::className();
        $this->beanSearchClass = CustomerSearch::className();
        parent::init();
    }

}
