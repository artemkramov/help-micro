<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use backend\models\Characteristic;
use backend\models\CharacteristicGroup;
use backend\models\search\CharacteristicGroupSearch;
use common\modules\i18n\Module;
use yii\web\NotFoundHttpException;

/**
 * CharacteristicGroupsController implements the CRUD actions for CharacteristicGroup model.
 */
class CharacteristicGroupsController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = CharacteristicGroup::className();
        $this->beanSearchClass = CharacteristicGroupSearch::className();
        parent::init();
    }

    /**
     * Sort and position action for menu
     * @param integer $id
     * @throws NotFoundHttpException
     * @return string
     */
    public function actionSort($id = null)
    {
        $beanClass = $this->beanClass;
        $group = $beanClass::findOne($id);
        if (empty($group)) {
            throw new NotFoundHttpException();
        }
        if (\Yii::$app->request->post()) {
            $jsonTree = \Yii::$app->request->post('jsonTree');
            if (!empty($jsonTree)) {
                Characteristic::saveSortPositions($jsonTree);
                \Yii::$app->session->setFlash('success', Module::t('Operation is done successfully.'));
                return $this->redirect(['sort', 'id' => $id]);
            }
        }
        return $this->render('sort', [
            'group' => $group
        ]);
    }

}
