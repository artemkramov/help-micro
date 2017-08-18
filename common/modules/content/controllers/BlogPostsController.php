<?php

namespace common\modules\content\controllers;

use backend\controllers\CRUDController;
use common\models\BlogPost;
use common\models\Search\BlogPostSearch;

/**
 * BlogPostsController implements the CRUD actions for BlogPost model.
 */
class BlogPostsController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = BlogPost::className();
        $this->beanSearchClass = BlogPostSearch::className();
        parent::init();
    }
}
