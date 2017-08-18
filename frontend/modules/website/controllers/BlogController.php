<?php

namespace frontend\modules\website\controllers;


use common\models\BlogCategory;
use common\models\BlogPost;
use frontend\models\BlogPostFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{

    /**
     * Init data
     */
    public function init()
    {
        \Yii::$app->params['template'] = 'content-cabinet';
        parent::init();
    }

    /**
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCategory($alias)
    {
        $blogCategory = BlogCategory::getCategoryByAlias($alias);
        $searchModel = new BlogPostFilter();
        $dataProvider = $searchModel->search($blogCategory);
        return $this->render('category', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'blogCategory' => $blogCategory
        ]);
    }

    /**
     * @param $categoryAlias
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionPost($categoryAlias, $alias)
    {
        $post = BlogPost::getPostByAlias($alias);
        return $this->render('post', [
            'post' => $post
        ]);
    }

}