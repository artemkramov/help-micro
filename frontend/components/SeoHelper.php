<?php

namespace frontend\components;

use backend\models\Category;
use backend\models\Product;
use common\models\BlogCategory;
use common\models\BlogPost;
use common\models\Magazine;
use common\models\Order;
use common\models\Setting;
use common\modules\i18n\Module;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\web\View;

/**
 * Class SeoHelper
 * @package frontend\components
 * Helper for the setting of the SEO features
 */
class SeoHelper
{

    /**
     * Setting of the title based on the type of the given bean
     * @param $viewData
     * @param $extraData
     * @throws Exception
     * @param $model
     */
    public static function setTitle($viewData, $extraData, $model)
    {
        if (!array_key_exists('type', $extraData)) {
            throw new Exception("Please provide the type of the breadcrumb");
        }
        $actionName = "handle" . ucfirst($extraData['type']);
        if (!method_exists(__CLASS__, $actionName)) {
            throw new Exception("No such method {$actionName} in the helper");
        }
        self::$actionName($viewData, $extraData, $model);
    }

    /**
     * Set SEO data for the posts
     * @param View $viewData
     * @param $extraData
     * @param $post
     */
    private static function handlePost($viewData, $extraData, $post)
    {
        $viewData->title = $post->title . ' : ' . \Yii::$app->name;
    }

    /**
     * @param $viewData
     * @param $extraData
     * @param $product
     */
    private static function handleCart($viewData, $extraData, $product)
    {
        $viewData->title = Module::t('Basket') . ' : ' . \Yii::$app->name;
    }

    /**
     * @param $viewData
     * @param $extraData
     * @param $product
     */
    private static function handleAccount($viewData, $extraData, $product)
    {
        $viewData->title = Module::t('Profile') . ' : ' . \Yii::$app->name;
    }

    /**
     * @param $viewData
     * @param $extraData
     * @param $product
     */
    private static function handleCheckout($viewData, $extraData, $product)
    {
        $viewData->title = Module::t('Checkout') . ' : ' . \Yii::$app->name;
    }


    /**
     * @param $viewData
     * @param $extraData
     * @param $collection
     */
    private static function handleSearch($viewData, $extraData, $collection)
    {
        $viewData->title = Module::t('Search') . ' : ' . \Yii::$app->name;
    }

    /**
     * @param $viewData
     * @param $extraData
     * @param $order
     */
    private static function handleOrders($viewData, $extraData, $order)
    {
        $viewData->title = Module::t('Orders') . ' : ' . \Yii::$app->name;
    }

    /**
     * @param $viewData
     * @param $extraData
     * @param $order
     */
    private static function handleOrder($viewData, $extraData, $order)
    {
        $viewData->title = Module::t('Order') . ' #' . $order->id . ' : ' . \Yii::$app->name;
    }

    /**
     * @param View $viewData
     * @param $extraData
     * @param BlogCategory $blogCategory
     */
    private static function handleBlogCategory($viewData, $extraData, $blogCategory)
    {
        $viewData->title = $blogCategory->title . ' : ' . \Yii::$app->name;
    }

    /**
     * @param View $viewData
     * @param $extraData
     * @param BlogPost $blogPost
     */
    private static function handleBlogPost($viewData, $extraData, $blogPost)
    {
        $viewData->title = $blogPost->title . ' : ' . \Yii::$app->name;
    }

    /**
     * @param View $viewData
     * @param $extraData
     * @param $category
     */
    private static function handleCategory($viewData, $extraData, $category)
    {
        $categoryList = mb_strtolower(implode(', ', array_slice(ArrayHelper::getColumn(Category::findAllLocalized(), 'title'), 0, 10)), 'utf-8');
        $viewData->registerMetaTag([
            'description' => $categoryList,
            'keywords'    => $categoryList . ', ' . \Yii::$app->name,
        ]);
        $viewData->title = Module::t('Product categories ') . ' ' . $category->title . ' : ' . \Yii::$app->name;
    }

    /**
     * @param View $viewData
     * @param $extraData
     * @param Product $product
     */
    private static function handleProduct($viewData, $extraData, $product)
    {
        $description = $product->title . ' ' . trim(str_replace(PHP_EOL, '', preg_replace('#<[^>]+>#', ' ', $product->content)));
        $categoryList = $product->getCategoriesList();
        $keywords = $product->title . ', ' . strip_tags($product->short_description) . ', ' . $categoryList;
        $title = $product->title . ', ' . $product->vendor_code . ' : ' . \Yii::$app->name;
        $viewData->registerMetaTag([
            'description' => $description,
            'keywords'    => mb_strtolower($keywords, 'utf-8'),
        ]);

        /**
         * Check if the link is canonical
         */
        $pathInfo = \Yii::$app->request->getPathInfo();
        $previousType = explode('/', $pathInfo);
        if ($previousType[0] == 'product') {
            $viewData->registerLinkTag([
                'ref'  => 'canonical',
                'href' => BaseUrl::current([], true)
            ]);
        }

        /**
         * Add the meta tags for social networks
         */
        $viewData->registerMetaTag([
            'content'  => \Yii::$app->request->hostInfo . $product->getDefaultImage(),
            'property' => 'og:image'
        ]);
        $viewData->registerMetaTag([
            'content'  => \Yii::$app->request->hostInfo . $product->getUrl(),
            'property' => 'og:url'
        ]);
        $viewData->registerMetaTag([
            'content'  => $title,
            'property' => 'og:title'
        ]);
        $viewData->registerMetaTag([
            'content'  => strip_tags($product->short_description),
            'property' => 'og:description'
        ]);
        $viewData->title = $title;
    }


}