<?php

namespace common\modules\content\controllers;

use backend\controllers\CRUDController;
use common\models\BlogCategory;
use common\models\Search\BlogCategorySearch;

/**
 * BlogCategoriesController implements the CRUD actions for BlogCategory model.
 */
class BlogCategoriesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = BlogCategory::className();
        $this->beanSearchClass = BlogCategorySearch::className();
        parent::init();
    }

}
