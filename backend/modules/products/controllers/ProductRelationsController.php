<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use backend\models\ProductRelation;
use backend\models\search\ProductRelationSearch;

/**
 * ProductRelationsController implements the CRUD actions for ProductRelation model.
 */
class ProductRelationsController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = ProductRelation::className();
        $this->beanSearchClass = ProductRelationSearch::className();
        parent::init();
    }

}
