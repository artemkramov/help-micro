<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/6/2016
 * Time: 4:11 PM
 */

namespace frontend\widgets;


use backend\components\SiteHelper;
use backend\models\Category;
use backend\models\Characteristic;
use backend\models\MenuType;
use backend\models\Product;
use common\models\Lang;
use common\models\Menu;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class MenuTopWidget
 * @package frontend\widgets
 * Widget for the building of the top menu
 */
class MenuTopWidget extends Widget
{

    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var array
     */
    private $callbackMenu = [
        5  => 'callbackNews',
        6  => 'callbackCollection',
        9  => 'callbackShop',
        25 => 'callbackSale',
    ];

    /**
     * Callbacks for the extended menu view
     * @var array
     */
    public static $callbackMenuExtended = [
        6 => 'callbackCollectionExtended',
        9 => 'callbackShopExtended'
    ];

    /**
     * Init view path
     */
    public function init()
    {
        $this->viewPath = 'menu-top' . DIRECTORY_SEPARATOR . 'view';
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        /**
         * @var MenuType $menuTopType
         */
        $menuTopType = MenuType::find()->where([
            'alias' => MenuType::TYPE_HEADER
        ])->one();
        $menuCollection = Menu::findAllWithTitle(null, $menuTopType->id);
        $menuTree = SiteHelper::buildTreeArrayFromCollection($menuCollection, 'id');
        foreach ($menuTree as $key => $menuRoot) {
            if (array_key_exists($menuRoot['id'], $this->callbackMenu)) {
                $methodName = $this->callbackMenu[$menuRoot['id']];
                if (method_exists($this, $methodName)) {
                    $menuTree[$key] = $this->{$methodName}($menuRoot);
                }
            }
            /**
             * Check if the root menu belongs to the current page
             * Then check it as active
             */
            if ($menuRoot['url'] == Url::current()) {
                $menuTree[$key]['active'] = true;
            }
        }
        return $this->render($this->viewPath, [
            'menuCollection' => $menuTree
        ]);
    }

    /**
     * @return array
     */
    public function getExtendedData()
    {
        $response = [];
        /**
         * @var MenuType $menuTopType
         */
        $menuTopType = MenuType::find()->where([
            'alias' => MenuType::TYPE_HEADER
        ])->one();
        /**
         * @var Menu[] $menuCollection
         */
        $menuCollection = Menu::find()->where([
            'enabled'      => 1,
            'parent_id'    => null,
            'menu_type_id' => $menuTopType->id
        ])->orderBy('sort')->all();
        foreach ($menuCollection as $menu) {
            if (array_key_exists($menu->id, self::$callbackMenuExtended)) {
                $methodName = self::$callbackMenuExtended[$menu->id];
                $data = $this->{$methodName}($menu);
            } else {
                $data = $this->getExtendedDataDefault($menu);
            }
            $response[$menu->id] = $data;
        }
        return $response;
    }

    /**
     * @param Menu $menu
     * @return array
     */
    public function getExtendedDataDefault($menu)
    {
        $children = Menu::find()->where([
            'parent_id' => $menu->id
        ])->orderBy('sort')->all();
        $subItems = [];
        foreach ($children as $child) {
            /**
             * @var Menu $child
             */
            $subItems[] = [
                'name'       => $child->title,
                'url'        => $child->getUrl(),
                'is_new_tab' => $child->is_new_tab
            ];
        }
        $blocks = [
            'image' => $menu->image,
            'items' => [
                [
                    'name'  => $menu->title,
                    'items' => $subItems,
                    'url'   => $menu->getUrl()
                ]
            ],
        ];
        return $blocks;
    }

    /**
     * @param $menu
     * @return mixed
     */
    public function callbackCollection($menu)
    {
        $children = array_key_exists('children', $menu) ? $menu['children'] : [];
        $collectionArray = Characteristic::getCollectionMenu(20);
        $result = [];
        foreach ($collectionArray as $key => $collection) {
            $result[] = $collection;
            foreach ($children as $childrenData) {
                if ($childrenData['sort'] == $key) {
                    $result[] = $childrenData;
                    break;
                }
            }
        }

        $menu['children'] = $result;
        return $menu;
    }

    /**
     * @param $menu
     * @return mixed
     */
    public function callbackSale($menu)
    {
        $menu['enabled'] = !empty(Product::getProductIdsWithAction(true));
        $menu['bold'] = true;
        return $menu;
    }

    /**
     * @param $menu
     * @return mixed
     */
    public function callbackNews($menu)
    {
        $menu['enabled'] = !empty(Product::getProductIdsNovelties(true));
        return $menu;
    }

    /**
     * @param $menu
     * @return mixed
     */
    public function callbackShop($menu)
    {
        $children = array_key_exists('children', $menu) ? $menu['children'] : [];
        $categoryCollection = Category::find()->where([
            'enabled'   => Category::STATUS_ENABLED,
            'parent_id' => null,
        ])->localized(Lang::getCurrent()->url)->orderBy('sort')->all();
        $data = [];
        foreach ($categoryCollection as $category) {
            /**
             * @var Category $category
             */
            $data[] = [
                'id'        => $category->id,
                'title'     => $category->title,
                'enabled'   => true,
                'directUrl' => $category->getUrl(),
            ];
        }
        $menu['children'] = ArrayHelper::merge($children, $data);
        $menu['type'] = 'shop';
        return $menu;
    }

    /**
     * @param Menu $menu
     * @return array
     */
    public function callbackCollectionExtended($menu)
    {
        $subItems = [];
        $children = Menu::find()->where([
            'enabled'   => 1,
            'parent_id' => $menu->id
        ])->orderBy('sort')->all();
        $collectionArray = Characteristic::getCollectionMenu(Characteristic::find()->count());
        foreach ($collectionArray as $key => $collection) {
            $subItems[] = [
                'name'        => $collection['title'],
                'url'         => $collection['directUrl'],
                'image'       => $collection['image'],
                'description' => $collection['description'],
                'campaign'    => $collection['campaign']
            ];
            foreach ($children as $childrenData) {
                /**
                 * @var Menu $childrenData
                 */
                if ($childrenData->sort == $key) {
                    $subItems[] = [
                        'name'        => $childrenData->title,
                        'url'         => $childrenData->getUrl(),
                        'is_new_tab'  => $childrenData->is_new_tab,
                        'image'       => $childrenData->getDefaultImage(),
                        'description' => preg_replace('~>\s+<~', '><', $childrenData->description)
                    ];
                    break;
                }
            }
        }
        $chunks = array_chunk($subItems, ceil(count($subItems) / 3));
        $items = [];
        foreach ($chunks as $key => $chunk) {
            $data = [
                'items' => $chunk,
                'name'  => $menu->title,
                'url'   => $menu->getUrl()
            ];
            if ($key !== 0) {
                $data['skip'] = true;
            }
            $items[] = $data;
        }
        $blocks = [
            'image' => $menu->image,
            'items' => $items,
        ];
        return $blocks;
    }

    /**
     * @param Menu $menu
     * @return array
     */
    public function callbackShopExtended($menu)
    {
        $items = [];
        /**
         * @var Category[] $categoryCollection
         */
        $categoryCollection = Category::find()->where([
            'enabled'   => Category::STATUS_ENABLED,
            'parent_id' => null,
        ])->localized(Lang::getCurrent()->url)->orderBy('sort')->all();
        /**
         * @var Menu $menuOwnModel
         */
        $menuOwnModel = Menu::findOne(35);
        $counter = 0;
        foreach ($categoryCollection as $category) {
            $subItems = [];
            /**
             * @var Category[] $children
             */
            $children = Category::find()->where([
                'enabled'   => Category::STATUS_ENABLED,
                'parent_id' => $category->id
            ])->orderBy('sort')->all();
            foreach ($children as $child) {
                $subItems[] = [
                    'name' => $child->title,
                    'url'  => $child->getUrl()
                ];
            }
            $counter++;
            if ($counter == count($categoryCollection) && $menuOwnModel->enabled) {
                $items[] = [
                    'name'  => $menuOwnModel->title,
                    'items' => [],
                    'url'   => $menuOwnModel->getUrl()
                ];
            } else {
                $items[] = [
                    'name'  => $category->title,
                    'items' => $subItems,
                    'url'   => $category->getUrl()
                ];
            }

        }
        return [
            'image' => $menu->image,
            'items' => $items,
        ];
    }


}