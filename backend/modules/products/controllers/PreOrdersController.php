<?php

namespace backend\modules\products\controllers;


use backend\controllers\CRUDController;
use common\models\PreOrder;
use common\models\Search\PreOrderSearch;
use yii\web\ForbiddenHttpException;

/**
 * Class PreOrdersController
 * @package backend\modules\products\controllers
 */
class PreOrdersController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = PreOrder::className();
        $this->beanSearchClass = PreOrderSearch::className();
        parent::init();
    }

    /**
     * @param array $extraParams
     * @throws ForbiddenHttpException
     * @return null
     */
    public function actionCreate($extraParams = [])
    {
        throw new ForbiddenHttpException();
    }

    /**
     * @param $id
     * @param bool $returnModel
     * @param array $extraParams
     * @throws ForbiddenHttpException
     * @return null
     */
    public function actionUpdate($id, $returnModel = false, $extraParams = [])
    {
        throw new ForbiddenHttpException();
    }

    /**
     * @param $id
     * @param bool $returnModel
     * @throws ForbiddenHttpException
     * @return null
     */
    public function actionDelete($id, $returnModel = false)
    {
        throw new ForbiddenHttpException();
    }


}