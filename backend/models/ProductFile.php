<?php

namespace backend\models;

use common\models\Bean;
use common\modules\i18n\Module;
use Yii;

/**
 * This is the model class for table "product_file".
 *
 * @property integer $id
 * @property string $file
 * @property integer $product_id
 * @property integer $sort
 * @property string $name
 */
class ProductFile extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file', 'product_id', 'name'], 'required'],
            [['product_id', 'sort'], 'integer'],
            [['file', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Module::t('Id'),
            'file'       => Module::t('File'),
            'product_id' => Module::t('Product'),
            'sort'       => Module::t('Sort'),
            'name'       => Module::t('Name'),
        ];
    }
}
