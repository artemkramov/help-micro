<?php

namespace backend\models\search;

use backend\models\Product;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductRelation;
use yii\web\NotFoundHttpException;

/**
 * ProductRelationSearch represents the model behind the search form about `backend\models\ProductRelation`.
 */
class ProductRelationSearch extends ProductRelation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['productAlias', 'productRelatedAlias'], 'string'],
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
        $query = ProductRelation::find();

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

        $productID = $this->product_id;
        $productRelatedID = $this->product_related_id;

        if (!empty($this->productAlias)) {
            try {
                /**
                 * @var Product $product
                 */
                $product = Product::getProductByAlias($this->productAlias);
                $productID = $product->id;
            } catch (NotFoundHttpException $ex) {
                $productID = -1;
            }
        }

        if (!empty($this->productRelatedAlias)) {
            try {
                $product = Product::getProductByAlias($this->productRelatedAlias);
                $productRelatedID = $product->id;
            } catch (NotFoundHttpException $ex) {
                $productRelatedID = -1;
            }
        }

        if (!empty($productID)) {
            $query->andWhere([
                'product_id' => $productID
            ]);
        }

        if (!empty($productRelatedID)) {
            $query->andWhere([
                'product_related_id' => $productRelatedID
            ]);
        }

        return $dataProvider;
    }
}
