<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use backend\models\Kit;
use backend\models\search\KitSearch;
use yii\bootstrap\ActiveForm;
use yii\web\NotFoundHttpException;
use Yii;
use yii\web\Response;

/**
 * KitsController implements the CRUD actions for Kit model.
 */
class KitsController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Kit::className();
        $this->beanSearchClass = KitSearch::className();
        parent::init();
    }

    /**
     * Ajax validation of the Product
     * Return JSON Response
     * @param null $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionValidate($id = null)
    {
        $model = new Kit();
        if (isset($id)) {
            $model = $this->findModel($id);
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $errors = ActiveForm::validate($model);
            return $errors;
        }
    }

}
