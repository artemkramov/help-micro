<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/7/2016
 * Time: 1:29 PM
 */

namespace frontend\modules\shop\controllers;


use backend\models\Category;
use backend\models\Characteristic;
use backend\models\Product;
use common\models\Lang;
use common\modules\i18n\Module;
use frontend\components\SearchSite;
use frontend\models\ProductFilter;
use frontend\widgets\MenuTopWidget;
use yii\base\Theme;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class CategoriesController
 * @package frontend\modules\shop\controllers
 */
class CategoriesController extends Controller
{

    /**
     * Init data
     */
    public function init()
    {
        \Yii::$app->params['template'] = 'content';
        parent::init();
    }

    /**
     * Show the list of the parent categories
     * @return string
     */
    public function actionIndex()
    {
//        \Yii::$app->params['template'] = 'content-wide';
        return $this->render('index', [
            'categories' => Category::getParentItems()
        ]);
    }

    /**
     * @param $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($alias)
    {
        $parts = explode('/', $alias);
        $categoryAlias = !empty($parts) ? end($parts) : null;
        $category = Category::getCategoryByAlias($categoryAlias);
        if (empty($categoryAlias) || empty($category)) {
            throw new NotFoundHttpException();
        }
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new ProductFilter();
        $dataProvider = $searchModel->search($queryParams, $category);
        $childCategories = Category::getChildCategories($category->id);
        $filterData = ProductFilter::getFilterData($category);

        if (\Yii::$app->request->isAjax) {

            return json_encode([
                'html'          =>
                    $this->renderPartial('products', [
                        'dataProvider' => $dataProvider
                    ]),
                'count'         => $dataProvider->totalCount,
                'paginationTop' => $this->renderPartial('_pagination-top', [
                    'dataProvider' => $dataProvider
                ])
            ]);
        }

        return $this->render('view', [
            'searchModel'     => $searchModel,
            'dataProvider'    => $dataProvider,
            'category'        => $category,
            'childCategories' => $childCategories,
            'filterData'      => $filterData,
            'selectedFilters' => $searchModel->getSelectedFilters($queryParams),
            'selectedSort'    => $searchModel->getSelectedSort($queryParams),
        ]);
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSale()
    {
        $productIds = Product::getProductIdsWithAction();
        if (empty($productIds)) {
            throw new NotFoundHttpException();
        }
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new ProductFilter();
        $dataProvider = $searchModel->search($queryParams, null, [
            'type' => 'sale'
        ]);
        $childCategories = [];

        $filterData = ProductFilter::getFilterData(null, [
            'productIds' => $productIds
        ]);

        if (\Yii::$app->request->isAjax) {

            return json_encode([
                'html'          =>
                    $this->renderPartial('products', [
                        'dataProvider' => $dataProvider
                    ]),
                'count'         => $dataProvider->totalCount,
                'paginationTop' => $this->renderPartial('_pagination-top', [
                    'dataProvider' => $dataProvider
                ])
            ]);
        }

        return $this->render('view', [
            'searchModel'     => $searchModel,
            'dataProvider'    => $dataProvider,
            'childCategories' => $childCategories,
            'filterData'      => $filterData,
            'selectedFilters' => $searchModel->getSelectedFilters($queryParams),
            'selectedSort'    => $searchModel->getSelectedSort($queryParams),
            'type'            => 'sale',
            'title'           => Module::t('Sell-out'),
        ]);
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionNovelties()
    {
        $productIds = Product::getProductIdsNovelties();
        if (empty($productIds)) {
            throw new NotFoundHttpException();
        }
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new ProductFilter();
        $dataProvider = $searchModel->search($queryParams, null, [
            'type' => 'novelty'
        ]);
        $childCategories = [];

        $filterData = ProductFilter::getFilterData(null, [
            'productIds' => $productIds
        ]);

        if (\Yii::$app->request->isAjax) {

            return json_encode([
                'html'          =>
                    $this->renderPartial('products', [
                        'dataProvider' => $dataProvider
                    ]),
                'count'         => $dataProvider->totalCount,
                'paginationTop' => $this->renderPartial('_pagination-top', [
                    'dataProvider' => $dataProvider
                ])
            ]);
        }

        return $this->render('view', [
            'searchModel'     => $searchModel,
            'dataProvider'    => $dataProvider,
            'childCategories' => $childCategories,
            'filterData'      => $filterData,
            'selectedFilters' => $searchModel->getSelectedFilters($queryParams),
            'selectedSort'    => $searchModel->getSelectedSort($queryParams),
            'type'            => 'novelty',
            'title'           => Module::t('Novelties products'),
        ]);
    }

    /**
     * @param string $alias
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionCollection($alias)
    {
        $collection = Characteristic::find()->where([
            'alias' => $alias
        ])
            ->one();
        $productIds = Product::getProductIdsCollection($alias);
        if (empty($collection)) {
            throw new NotFoundHttpException();
        }
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new ProductFilter();
        $dataProvider = $searchModel->search($queryParams, null, [
            'type'       => 'collection',
            'alias'      => $alias,
            'collection' => $collection,
        ]);
        $childCategories = [];

        $filterData = ProductFilter::getFilterData(null, [
            'productIds' => $productIds
        ]);

        /**
         * Remove collection selection from the filter
         */
        foreach ($filterData as $key => $characteristicGroup) {
            if ($characteristicGroup->alias == 'collection') {
                unset($filterData[$key]);
            }
        }

        if (\Yii::$app->request->isAjax) {

            return json_encode([
                'html'          =>
                    $this->renderPartial('products', [
                        'dataProvider' => $dataProvider
                    ]),
                'count'         => $dataProvider->totalCount,
                'paginationTop' => $this->renderPartial('_pagination-top', [
                    'dataProvider' => $dataProvider
                ])
            ]);
        }
        return $this->render('view', [
            'searchModel'     => $searchModel,
            'dataProvider'    => $dataProvider,
            'childCategories' => $childCategories,
            'filterData'      => $filterData,
            'selectedFilters' => $searchModel->getSelectedFilters($queryParams),
            'selectedSort'    => $searchModel->getSelectedSort($queryParams),
            'type'            => 'collection',
            'category'        => $collection,
            'title'           => $collection->title
        ]);
    }

    public function actionCollections()
    {
        $menuTopWidget = new MenuTopWidget();
        $collectionsData = $menuTopWidget->getExtendedData();
        $items = $collectionsData[6]["items"];


        return $this->render('collections', [
            'items' => $items
        ]);
    }

    /**
     * @param $keywords
     * @return string
     */
    public function actionSearch($keywords)
    {
        $keywords = substr($keywords, 0, 50);
        /**
         * @var Lang $currentLanguage
         */
        $currentLanguage = Lang::getCurrent();
        $searchComponent = new SearchSite($currentLanguage->local);
        $productIds = $searchComponent->search($keywords);
        $queryParams = \Yii::$app->request->queryParams;
        $searchModel = new ProductFilter();
        $dataProvider = $searchModel->search($queryParams, null, [
            'type'       => 'search',
            'productIds' => $productIds,
        ]);
        $childCategories = [];

        $filterData = ProductFilter::getFilterData(null, [
            'productIds' => $productIds
        ]);

        if (\Yii::$app->request->isAjax) {

            return json_encode([
                'html'          =>
                    $this->renderPartial('products', [
                        'dataProvider' => $dataProvider
                    ]),
                'count'         => $dataProvider->totalCount,
                'paginationTop' => $this->renderPartial('_pagination-top', [
                    'dataProvider' => $dataProvider
                ])
            ]);
        }

        if (empty($productIds)) {
            return $this->render('search-no-results', [
                'title'    => Module::t('Search results:') . ' ' . $keywords,
                'keywords' => $keywords,
            ]);
        }

        return $this->render('view', [
            'searchModel'     => $searchModel,
            'dataProvider'    => $dataProvider,
            'childCategories' => $childCategories,
            'filterData'      => $filterData,
            'selectedFilters' => $searchModel->getSelectedFilters($queryParams),
            'selectedSort'    => $searchModel->getSelectedSort($queryParams),
            'type'            => 'search',
            'title'           => Module::t('Search results:') . ' ' . $keywords,
        ]);
    }

}