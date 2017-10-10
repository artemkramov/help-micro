<?php

namespace backend\modules\settings\controllers;

use backend\controllers\CRUDController;
use common\models\Novelty;
use common\models\Search\NoveltySearch;

/**
 * NoveltiesController implements the CRUD actions for Novelty model.
 */
class NoveltiesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Novelty::className();
        $this->beanSearchClass = NoveltySearch::className();
        parent::init();
    }

}
