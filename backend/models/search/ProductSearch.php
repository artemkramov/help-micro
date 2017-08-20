<?php

namespace backend\models\search;

use common\models\Lang;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'enabled'    => $this->enabled,
            'sort'       => $this->sort,
            'price'      => $this->price,
            'in_stock'   => $this->in_stock,
        ]);

        $query->andFilterWhere(['like', 'vendor_code', $this->vendor_code])
            ->andFilterWhere(['like', 'alias', $this->alias]);

        /**
         * Filtering by the multilingual fields
         */
        $query->join('left join', $this->tableLang, $this->tableLang . '.product_id = ' . self::tableName() . '.id');

        $query->andFilterWhere([
            'like', 'title', $this->title,
        ])->andFilterWhere([
            'like', 'language', Lang::getCurrent()->url
        ]);

        $query->distinct();

        /**
         * Filtering by the category
         */
        $query->join('left join', self::TABLE_PRODUCT_CATEGORY, self::TABLE_PRODUCT_CATEGORY . '.product_id = ' . self::tableName() . '.id');
        $query->andFilterWhere([
            'like', self::TABLE_PRODUCT_CATEGORY . '.category_id', $this->category_ids
        ]);

        return $dataProvider;
    }
}
