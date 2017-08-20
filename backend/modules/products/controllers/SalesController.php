<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use common\models\Sale;
use common\models\Search\SaleSearch;

/**
 * SalesController implements the CRUD actions for Sale model.
 */
class SalesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Sale::className();
        $this->beanSearchClass = SaleSearch::className();
        parent::init();
    }

}
