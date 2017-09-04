<?php

namespace backend\models;

use common\models\Bean;
use common\modules\i18n\Module;
use Yii;

/**
 * This is the model class for table "product_link".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $title
 * @property string $link
 *
 * @property Product $product
 */
class ProductLink extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'link'], 'required'],
            [['product_id'], 'integer'],
            [['title', 'link'], 'string', 'max' => 255],
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
            'product_id' => Module::t('Product'),
            'title'      => Module::t('Title'),
            'link'       => Module::t('Link'),
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
