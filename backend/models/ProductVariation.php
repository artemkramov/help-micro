<?php

namespace backend\models;

use common\models\Bean;
use common\modules\i18n\Module;
use Yii;

/**
 * This is the model class for table "product_variation".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $characteristic_id
 * @property double $price
 * @property integer $currency_id
 * @property integer $in_stock
 *
 * @property Characteristic $characteristic
 * @property Product $product
 */
class ProductVariation extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_variation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'characteristic_id', 'price', 'currency_id'], 'required'],
            [['product_id', 'characteristic_id', 'currency_id', 'in_stock'], 'integer'],
            [['price'], 'number'],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::className(), 'targetAttribute' => ['characteristic_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Module::t('Id'),
            'product_id'        => Module::t('Product'),
            'characteristic_id' => Module::t('Characteristic'),
            'price'             => Module::t('Price'),
            'currency_id'       => Module::t('Currency'),
            'in_stock'          => Module::t('In stock'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::className(), ['id' => 'characteristic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
