<?php

namespace frontend\modules\page\controllers;

use backend\models\Category;
use backend\models\Product;
use common\components\Mailer;
use common\models\Post;
use common\models\User;
use common\modules\i18n\Module;
use frontend\models\ContactForm;
use skeeks\yii2\assetsAuto\AssetsAutoCompressComponent;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `page` module
 */
class DefaultController extends Controller
{

    /**
     * @param $url
     * @param $previewMode
     * @return string
     */
    public function actionShow($url = '', $previewMode = null)
    {
        if (empty($url)) {
            $post = Post::findDefaultPage();
        } else {
            if (!User::isAdmin()) {
                $previewMode = null;
            }
            $post = Post::findByAlias($url, $previewMode);
        }

        $template = 'content';
        if (!empty($post->template)) {
            $template = $post->template;
        }
        /**
         * Load custom template if available
         */
        \Yii::$app->params['template'] = $template . '.php';
        $defaultViewName = 'index';
        $view = 'page-' . $post->alias;
        if (!file_exists($this->viewPath . DIRECTORY_SEPARATOR . $view . '.php')) {
            $view = $defaultViewName;
        }
        /**
         * Load extra data
         */
        $extraData = [];
        $actionName = 'loadData' . Inflector::id2camel($post->alias);
        if (method_exists($post, $actionName)) {
            $extraData = $post->{$actionName}();
        }

        /**
         * Call custom action if needed
         */
        $actionName = 'handler' . Inflector::id2camel($post->alias);
        if (method_exists($this, $actionName)) {
            return $this->{$actionName}($view, $post, $extraData);
        }

        return $this->render($view, [
            'post'      => $post,
            'extraData' => $extraData
        ]);
    }

    /**
     * @param $view
     * @param $post
     * @param $extraData
     * @return string
     */
    public function handlerContacts($view, $post, $extraData)
    {
        $contactFormModel = new ContactForm();
        if (\Yii::$app->request->post() && $contactFormModel->load(\Yii::$app->request->post()) && $contactFormModel->validate()) {
            $contactFormModel->sendEmail();
            \Yii::$app->session->setFlash('success', Module::t('Your message was sent successfully. Thank you.'));
            return $this->redirect(Url::current() . '#w1-success-0');
        }
        return $this->render($view, [
            'post'        => $post,
            'extraData'   => $extraData,
            'contactForm' => $contactFormModel,
        ]);
    }

    /**
     * @param $view
     * @param $post
     * @param $extraData
     * @return string
     */
    public function handlerHome($view, $post, $extraData)
    {
        $lastProducts = Product::getLastProducts(3);
        return $this->render($view, [
            'post'      => $post,
            'extraData' => $extraData,
            'novelties' => $lastProducts,
        ]);
    }

    /**
     * @param $view
     * @param $post
     * @param $extraData
     * @return string
     */
    public function handlerShop($view, $post, $extraData)
    {
        return $this->render($view, [
            'post'       => $post,
            'extraData'  => $extraData,
            'categories' => Category::getParentItems(),
        ]);
    }

    /**
     * @param $alias
     * @return array
     */
    public function actionLegacy($alias)
    {
        $postsSlugs = [
            'usloviya-ispolzovaniya', 'usloviya-prodaji', 'politika-vozvrata', 'politika-konfidencialnosti', 'polojenie-o-konfidencialnosti'
        ];
        $posts = [];
        $post = null;
        foreach ($postsSlugs as $slug) {
            $item = Post::findByAlias($slug, true);
            if ($slug == $alias) {
                $post = $item;
            }
            $posts[] = $item;
        }
        if (!empty($alias)) {
            $post = Post::findByAlias($alias, true);
        } else {
            $post = reset($posts);
        }

        return $this->render('page-legacy', [
            'post'  => $post,
            'items' => $posts
        ]);
    }

}
