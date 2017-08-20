<?php

namespace backend\models;

use common\models\Bean;
use common\modules\i18n\Module;
use Yii;

/**
 * This is the model class for table "product_gallery".
 *
 * @property integer $id
 * @property string $image
 * @property integer $product_id
 * @property integer $sort
 *
 * @property Product $product
 */
class ProductGallery extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'product_id'], 'required'],
            [['product_id', 'sort'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Module::t('Id'),
            'image'      => Module::t('Image'),
            'product_id' => Module::t('Product'),
            'sort'       => Module::t('Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
