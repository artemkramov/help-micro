<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use backend\models\Product;
use backend\models\search\ProductSearch;
use common\models\PreOrder;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ProductsController implements the CRUD actions for Product model.
 */
class ProductsController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Product::className();
        $this->beanSearchClass = ProductSearch::className();
        $this->enableCsrfValidation = false;
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
        $model = new Product();
        if (isset($id)) {
            $model = $this->findModel($id);
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $errors = ActiveForm::validate($model);
            return $errors;
        }
    }

    public function actionPreOrderTest()
    {
        PreOrder::sendNotifications();
    }

}
