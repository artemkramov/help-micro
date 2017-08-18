<?php

namespace frontend\widgets;

use backend\models\Category;
use backend\models\Characteristic;
use backend\models\MenuType;
use backend\models\Product;
use common\models\Bean;
use common\models\BlogPost;
use common\models\Lang;
use common\models\Menu;
use common\models\Order;
use common\models\Post;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;

class BreadcrumbWidget extends Widget
{

    /**
     * @var Bean
     */
    public $model;

    /**
     * @var string
     */
    public $type = 'common';

    /**
     * @var string
     */
    public $commonName = '';

    /**
     * @return string
     */
    public function run()
    {
        /**
         * @var Lang $currentLanguage
         */
        $currentLanguage = Lang::getCurrent();
        $list = [
            [
                'title'  => Module::t('Main'),
                'url'    => Url::base(true) . '/' . $currentLanguage->url,
                'isLink' => true
            ]
        ];
        $methodName = 'getList' . Inflector::camelize($this->type);
        if (method_exists($this, $methodName)) {
            $list = ArrayHelper::merge($list, $this->{$methodName}());
        }
        return $this->render('breadcrumb/view', [
            'items' => $list
        ]);
    }

    /**
     * @return array
     */
    public function getListPage()
    {
        /**
         * @var Post $page
         */
        $page = $this->model;
        $list = [];
        if (!$page->default) {
            $list[] = [
                'title' => $page->title,
                'url'   => $page->getUrl(),
                'isUrl' => true
            ];
        }
        return $list;
    }

    /**
     * @return array
     */
    public function getListCommon()
    {
        $list = [];
        $list[] = [
            'title' => $this->commonName,
            'url'   => Url::current(),
            'isUrl' => true
        ];
        return $list;
    }

    /**
     * @return array
     */
    public function getListLegacy()
    {
        return ArrayHelper::merge([[
            'title' => Module::t('Legacy section'),
            'url'   => FrontendHelper::formLink('/legacy')
        ]], $this->getListCommon());
    }

    /**
     * @return array
     */
    public function getListNovelty()
    {
        return $this->getListCommon();
    }

    /**
     * @return array
     */
    public function getListSale()
    {
        return $this->getListCommon();
    }

    /**
     * @return array
     */
    public function getListCollections()
    {
        return $this->getListCommon();
    }

    /**
     * @return array
     */
    public function getListCollection()
    {
        $list = [
            [
                'title' => Module::t('Collections'),
                'url'   => FrontendHelper::formLink('/collections'),
                'isUrl' => true
            ]
        ];
        return ArrayHelper::merge($list, $this->getListCommon());
    }

    /**
     * @param Category $category
     * @return array
     */
    public function getListCategory($category = null)
    {
        if (!isset($category)) {
            $category = $this->model;
        }
        $list = [
            [
                'title' => Module::t('Shop'),
                'url'   => FrontendHelper::formLink('/shop'),
                'isUrl' => true
            ]
        ];
        $parentCategories = $category->getParentCategories();
        foreach ($parentCategories as $parentCategory) {
            /**
             * @var Category $parentCategory
             */
            $list[] = [
                'title' => $parentCategory->title,
                'url'   => $parentCategory->getUrl(),
                'isUrl' => true
            ];
        }
        $list[] = [
            'title' => $category->title,
            'url'   => $category->getUrl(),
            'isUrl' => true
        ];
        return $list;
    }

    /**
     * @return array
     */
    public function getListProduct()
    {
        /**
         * @var Product $product
         */
        $product = $this->model;
        $pathInfo = \Yii::$app->request->getPathInfo();
        $previousType = explode('/', $pathInfo);
        $category = $product->getClosestCategory();
        $productUrl = $product->getUrl($previousType[0]);
        switch ($previousType[0]) {
            case 'novelty':
                $list = [
                    [
                        'title' => Module::t('New products'),
                        'url'   => FrontendHelper::formLink('/novelties'),
                        'isUrl' => true
                    ]
                ];
                break;
            case 'sale':
                $list = [
                    [
                        'title' => Module::t('Sale'),
                        'url'   => FrontendHelper::formLink('/sale'),
                        'isUrl' => true
                    ]
                ];
                break;
            case 'collection':
                /**
                 * @var Characteristic $collection
                 */
                $collection = Characteristic::find()->where([
                    'alias' => $previousType[1],
                ])->one();
                $list = [
                    [
                        'title' => Module::t('Collections'),
                        'url'   => FrontendHelper::formLink('/collections'),
                        'isUrl' => true
                    ],
                    [
                        'title' => $collection->title,
                        'url'   => $collection->getUrl(),
                        'isUrl' => true
                    ]
                ];
                $productUrl = $product->getUrl('collection/' . $collection->alias);
                break;
            default:
                $productUrl = $product->getUrl();
                $list = $this->getListCategory($category);
                array_pop($list);
        }
        $list[] = [
            'title' => $product->title,
            'url'   => $productUrl,
            'isUrl' => true
        ];
        return $list;
    }

    /**
     * @return array
     */
    public function getListAccount()
    {
        $list = [
            [
                'title' => Module::t('Profile'),
                'url'   => FrontendHelper::formLink('/cabinet/account/index'),
                'isUrl' => true
            ]
        ];
        if (!empty($this->commonName)) {
            $list[] = [
                'title' => $this->commonName,
                'url'   => Url::current(),
                'isUrl' => true
            ];
        }

        return $list;
    }

    /**
     * @return array
     */
    public function getListAccountOrderView()
    {
        /**
         * @var Order $order
         */
        $order = $this->model;
        $list = $this->getListAccount();
        $list[] = [
            'title' => Module::t('Orders'),
            'url'   => FrontendHelper::formLink('/cabinet/account/orders'),
            'isUrl' => true
        ];
        $list[] = [
            'title' => Module::t('Order') . ' #' . $order->id,
            'url'   => Url::current(),
            'isUrl' => true
        ];
        return $list;
    }

    /**
     * @return array
     */
    public function getListBlogPost()
    {
        /**
         * @var BlogPost $blogPost
         */
        $blogPost = $this->model;
        $list = [
            [
                'title' => $blogPost->blogCategory->title,
                'url'   => FrontendHelper::formLink($blogPost->blogCategory->getUrl()),
                'isUrl' => true
            ]
        ];
        $list[] = [
            'title' => $blogPost->title,
            'url'   => Url::current(),
            'isUrl' => true
        ];

        return $list;
    }


}