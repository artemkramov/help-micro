<?php

namespace backend\modules\products\controllers;

use backend\controllers\CRUDController;
use backend\models\Category;
use backend\models\search\CategorySearch;
use common\modules\i18n\Module;

/**
 * CategoriesController implements the CRUD actions for Category model.
 */
class CategoriesController extends CRUDController
{
    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = Category::className();
        $this->beanSearchClass = CategorySearch::className();
        parent::init();
    }

    /**
     * Sort and position action for menu
     * @return string
     */
    public function actionSort()
    {
        if (\Yii::$app->request->post()) {
            $jsonTree = \Yii::$app->request->post('jsonTree');
            if (!empty($jsonTree)) {
                $beanClass = $this->beanClass;
                $collection = json_decode($jsonTree);
                if (is_array($collection)) {
                    $beanClass::saveTree($collection);
                }
                \Yii::$app->session->setFlash('success', Module::t('Operation is done successfully.'));
                return $this->redirect(['sort']);
            }
        }
        return $this->render('sort');
    }
}
