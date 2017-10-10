<?php

namespace frontend\modules\api\controllers;


use common\models\Customer;
use common\models\Novelty;
use frontend\models\CustomerFind;
use yii\helpers\Url;
use yii\rest\ActiveController;

class NoveltyController extends ActiveController
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
        unset($actions['create']);
        unset($actions['update']);
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
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionGetNovelties()
    {
        $directoryAsset = \Yii::$app->assetManager->getPublishedUrl(\Yii::$app->params['themePath']);
        /**
         * @var Novelty[] $records
         */
        $records = Novelty::getLastNovelties();
        foreach ($records as $record) {
            $record->created_at = date('Y-m-d', $record->created_at);
            if (empty($record->photo)) {
                $record->photo = Url::to($directoryAsset . '/images/logo-pp.png', true);
            }
        }
        return $records;
    }

    /**
     * @param $noveltyID
     * @return array
     */
    public function actionGetUnreadCount($noveltyID)
    {
        return [
            'count' => Novelty::getUnreadCount($noveltyID)
        ];
    }

}