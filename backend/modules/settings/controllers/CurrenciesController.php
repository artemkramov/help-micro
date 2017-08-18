<?php

namespace backend\modules\settings\controllers;

use backend\controllers\CRUDController;
use Yii;
use backend\models\Currency;
use backend\models\search\CurrencySearch;

/**
 * CurrenciesController implements the CRUD actions for Currency model.
 */
class CurrenciesController extends CRUDController
{

    public function init()
    {
        $this->beanClass = Currency::className();
        $this->beanSearchClass = CurrencySearch::className();
        parent::init(); // TODO: Change the autogenerated stub
    }

}