<?php

namespace frontend\modules\api\controllers;


use common\models\Customer;
use common\models\Novelty;
use frontend\models\CustomerFind;
use yii\rest\ActiveController;

class CustomerController extends ActiveController
{

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['delete']);
        unset($actions['options']);
        return $actions;
    }

    /**
     * Init customer model class
     */
    public function init()
    {
        $this->modelClass = Customer::className();
        header('Access-Control-Allow-Origin: *');
        parent::init();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin'                           => "*",
                'Access-Control-Request-Method'    => ['POST', 'GET'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,
                'Access-Control-Allow-Origin'      => "*"
            ],
        ];
        return $behaviors;
    }


    /**
     * @return array
     */
    public function actionGetRecord()
    {
        header('Access-Control-Allow-Origin: *');
        $params = \Yii::$app->request->post();
        $customerFind = new CustomerFind();
        if ($customerFind->load([
            'CustomerFind' => $params
        ]) && $customerFind->validate()) {
            $customer = Customer::findBySerial($customerFind->serial);
            return $customer;
        }
        else {

            \Yii::$app->response->setStatusCode(422);
            return $customerFind->getErrors();
        }
    }

}