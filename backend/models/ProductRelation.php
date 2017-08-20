<?php

namespace backend\models;

use common\models\Bean;
use common\modules\i18n\Module;
use Yii;

/**
 * This is the model class for table "product_relation".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $product_related_id
 *
 * @property Product $productRelated
 * @property Product $product
 */
class ProductRelation extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_relation';
    }

    /**
     * @var string
     */
    public $productImage;

    /**
     * @var string
     */
    public $productAlias;

    /**
     * @var string
     */
    public $productRelatedImage;

    /**
     * @var string
     */
    public $productRelatedAlias;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'product_related_id'], 'required'],
            [['product_id', 'product_related_id'], 'integer'],
            [['product_id', 'product_related_id'], 'unique', 'targetAttribute' => ['product_id', 'product_related_id'], 'message' => Module::t('Such combination of products already exists.')],
            [['product_related_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_related_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            ['product_id', 'compare', 'compareAttribute' => 'product_related_id', 'operator' => '!=', 'message' => Module::t('Please choose the different products')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                 => Module::t('Id'),
            'product_id'         => Module::t('Product'),
            'product_related_id' => Module::t('Product related')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelated()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_related_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Product relation',
            'multiple' => 'Product relations'
        ];
    }

}
