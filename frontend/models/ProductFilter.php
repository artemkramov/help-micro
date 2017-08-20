<?php

namespace frontend\models;

use backend\models\Category;
use backend\models\Characteristic;
use backend\models\CharacteristicGroup;
use common\models\Lang;
use common\models\Sale;
use common\models\SaleProduct;
use common\modules\i18n\Module;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductFilter extends Product
{

    private $sortKey = 'sort';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'enabled', 'sort', 'in_stock', 'category_ids'], 'integer'],
            [['vendor_code', 'alias'], 'safe'],
            [['price'], 'number'],
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param $category
     * @param $extraData
     *
     * @return ActiveDataProvider
     */
    public function search($params, $category = null, $extraData = [])
    {
        $query = Product::find();

        $query->andWhere([
            self::tableName() . '.enabled' => self::STATUS_ENABLED
        ]);

        $searchKey = $this->getShortName();
        /**
         * Begin to filter
         */
        if (array_key_exists($searchKey, $params)) {
            $productIds = $this->buildFilterQuery($params[$searchKey]);
            $query->andWhere([
                'in', self::tableName() . '.id', $productIds
            ]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
            'sort'       => [
                'defaultOrder' => [
                    'in_stock' => SORT_DESC
                ]
            ]
        ]);

        /**
         * Filtering by the category
         */
        if (isset($category)) {
            $query->join('left join', self::TABLE_PRODUCT_CATEGORY, self::TABLE_PRODUCT_CATEGORY . '.product_id = ' . self::tableName() . '.id');
            $query->andWhere([
                self::TABLE_PRODUCT_CATEGORY . '.category_id' => $category->id
            ]);
        }

        $query->distinct();

        $query->localized(Lang::getCurrent()->url);

        if (array_key_exists('type', $extraData)) {
            $methodName = 'filter' . Inflector::camelize($extraData['type']);
            if (method_exists($this, $methodName)) {
                $this->{$methodName}($query, $extraData);
            }
        }

        return $dataProvider;
    }

    /**
     * @param ActiveQuery $query
     * @param $extraData
     */
    public function filterSale($query, $extraData)
    {
        $query->join('inner join', SaleProduct::tableName(), SaleProduct::tableName() . '.product_id = ' . self::tableName() . '.id');
        $query->join('inner join', Sale::tableName(), Sale::tableName() . '.id = ' . SaleProduct::tableName() . '.sale_id');
        $query->andWhere([
            Sale::tableName() . '.enabled' => Sale::STATUS_ENABLED,
        ]);
    }

    /**
     * @param ActiveQuery $query
     * @param $extraData
     */
    public function filterSearch($query, $extraData)
    {
        $query->andWhere([
            'in', Product::tableName() . '.id', $extraData['productIds']
        ]);
    }

    /**
     * @param ActiveQuery $query
     * @param $extraData
     */
    public function filterNovelty($query, $extraData)
    {
        Product::isNoveltyCondition($query);
    }

    /**
     * @param ActiveQuery $query
     * @param $extraData
     */
    public function filterCollection($query, $extraData)
    {
        Product::isInCollectionCondition($query, $extraData['alias']);
    }

    /**
     * @param $category
     * @param $extraData
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getFilterData($category, $extraData = [])
    {
        $groups = CharacteristicGroup::getRecordsForFilter();
        foreach ($groups as $key => $group) {
            $query = Characteristic::find()
                ->join('inner join', self::TABLE_PRODUCT_CHARACTERISTIC,
                    self::TABLE_PRODUCT_CHARACTERISTIC . '.characteristic_id = ' . Characteristic::tableName() . '.id')
                ->join('inner join', self::TABLE_PRODUCT_CATEGORY, self::TABLE_PRODUCT_CATEGORY . '.product_id = ' .
                    self::TABLE_PRODUCT_CHARACTERISTIC . '.product_id')
                ->where([
                    Characteristic::tableName() . '.characteristic_group_id' => $group->id
                ]);

            if (isset($category)) {
                $query = $query->andWhere([
                    self::TABLE_PRODUCT_CATEGORY . '.category_id' => $category->id,
                ]);
            }

            if (array_key_exists('productIds', $extraData)) {
                $query->andWhere([
                    'in', self::TABLE_PRODUCT_CHARACTERISTIC . '.product_id', $extraData['productIds']
                ]);
            }

            $characteristics = $query->distinct()->all();

            if (empty($characteristics)) {
                unset($groups[$key]);
                continue;
            }
            $group->filterCharacteristics = $characteristics;
        }
        return ArrayHelper::merge(self::getFilterCategories($category), $groups);
    }

    /**
     * @param Category $parentCategory
     * @return array
     */
    public static function getFilterCategories($parentCategory)
    {
        $response = [];
        $query = Category::find()
            ->where([
                'enabled' => Category::STATUS_ENABLED
            ]);

        $query->andWhere([
            'parent_id' => isset($parentCategory) ? $parentCategory->id : null
        ]);


        $categories = $query->all();
        if (!empty($categories)) {
            if (isset($parentCategory)) {
                $group = self::formGroupFromCategory($parentCategory);
                $group->filterCharacteristics = $categories;
                $response[$parentCategory->alias] = $group;
            } else {
                foreach ($categories as $category) {
                    /**
                     * @var Category $category
                     */
                    $group = self::formGroupFromCategory($category);
                    $group->filterCharacteristics = Category::find()
                        ->where([
                            'enabled'   => Category::STATUS_ENABLED,
                            'parent_id' => $category->id,
                        ])
                        ->all();
                    $response[$category->alias] = $group;
                }
            }
        }
        return $response;
    }

    /**
     * @param $category
     * @return \stdClass
     */
    private static function formGroupFromCategory($category)
    {
        $group = new \stdClass();
        $group->title = $category->title;
        $group->alias = $category->alias;
        $group->filterCharacteristics = [];
        return $group;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        $function = new \ReflectionClass(self::className());
        return $function->getShortName();
    }

    /**
     * @param $params
     * @return array
     */
    public function getSelectedFilters($params)
    {
        $searchKey = $this->getShortName();
        $response = [];
        if (array_key_exists($searchKey, $params)) {
            foreach ($params[$searchKey] as $attribute => $data) {
                $response = ArrayHelper::merge($response, $data);
            }
        }
        return $response;
    }

    /**
     * @param $params
     * @return string
     */
    public function getSelectedSort($params)
    {
        $sortKey = $this->sortKey;
        if (array_key_exists($sortKey, $params)) {
            return $params[$sortKey];
        }
        return '';
    }

    /**
     * @param $params
     * @return array
     */
    private function buildFilterQuery($params)
    {
        $sqlData = [];
        foreach ($params as $attribute => $data) {
            $isCategory = !CharacteristicGroup::find()
                ->where([
                    'alias' => $attribute
                ])
                ->count();
            $sqlData[] = !$isCategory ? $this->buildQuery($data, $attribute) : $this->buildQueryCategory($data);
        }
        $sql = "";
        for ($i = 0; $i < count($sqlData); $i++) {
            $sql .= $sqlData[$i];
            if ($i != 0) {
                $sql .= ')';
            }
            if ($i != count($sqlData) - 1) {
                $sql .= " and " . self::tableName() . '.id in (';
            }
        }
        $sqlResult = \Yii::$app->db->createCommand($sql)->queryAll();
        return ArrayHelper::getColumn($sqlResult, 'id');
    }

    /**
     * @param $params
     * @param $alias
     * @param bool $first
     * @return string
     */
    private function buildQuery($params, $alias, $first = false)
    {
        $column = self::tableName() . '.' . ($first ? '*' : 'id');
        $sql = "select distinct " . $column . " from " . self::tableName() . " 
            inner join " . self::TABLE_PRODUCT_CHARACTERISTIC . " on " . self::TABLE_PRODUCT_CHARACTERISTIC . ".product_id = " . self::tableName() . ".id
            inner join " . Characteristic::tableName() . " on " . Characteristic::tableName() . ".id = " . self::TABLE_PRODUCT_CHARACTERISTIC . ".characteristic_id
            inner join " . CharacteristicGroup::tableName() . " on " . CharacteristicGroup::tableName() . ".id = " . Characteristic::tableName() . ".characteristic_group_id
            where " . CharacteristicGroup::tableName() . ".alias = '" . $alias . "' and " .
            self::TABLE_PRODUCT_CHARACTERISTIC . ".characteristic_id in (" . implode($params, ',') . ")";
        return $sql;
    }

    /**
     * @param $params
     * @param bool $first
     * @return string
     */
    private function buildQueryCategory($params, $first = false)
    {
        $column = self::tableName() . '.' . ($first ? '*' : 'id');
        $sql = "select distinct " . $column . " from " . self::tableName() . " 
            inner join " . self::TABLE_PRODUCT_CATEGORY . " on " . self::TABLE_PRODUCT_CATEGORY . ".product_id = " . self::tableName() . ".id
            where " . self::TABLE_PRODUCT_CATEGORY . ".category_id in (" . implode($params, ',') . ")";
        return $sql;
    }


    /**
     * @return array
     */
    public static function getSortDropdown()
    {
        return [
            ''       => Module::t('Sort by'),
            '-price' => Module::t('Price High to Low'),
            'price'  => Module::t('Price Low to High')
        ];
    }

}
