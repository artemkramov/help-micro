<?php

namespace frontend\models;


use common\models\BlogCategory;
use common\models\BlogPost;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BlogPostFilter extends BlogPost
{

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
     * @param BlogCategory $category
     * @return ActiveDataProvider
     */
    public function search($category)
    {
        $query = BlogPost::find();

        $query->andWhere([
            'blog_category_id' => $category->id,
            'enabled'          => self::STATUS_ENABLED
        ]);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
            'sort'       => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],

        ]);
        return $dataProvider;
    }

}