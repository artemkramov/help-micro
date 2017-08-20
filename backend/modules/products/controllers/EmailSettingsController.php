<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use common\models\EmailSetting;
use common\models\Search\EmailSettingSearch;
use yii\web\ForbiddenHttpException;

/**
 * EmailSettingsController implements the CRUD actions for EmailSetting model.
 */
class EmailSettingsController extends CRUDController
{
    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = EmailSetting::className();
        $this->beanSearchClass = EmailSettingSearch::className();
        parent::init();
    }

    public function actionCreate($extraParams = [])
    {
        throw new ForbiddenHttpException();
    }

    public function actionDelete($id, $returnModel = false)
    {
        throw new ForbiddenHttpException();
    }
}
