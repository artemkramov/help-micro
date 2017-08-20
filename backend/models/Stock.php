<?php

namespace backend\models;

use common\components\MultilingualBehavior;
use common\models\Bean;
use common\models\Lang;
use common\modules\i18n\Module;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stock".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $enabled
 * @property integer $sort
 *
 */
class Stock extends Bean
{

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    protected $tableLang = 'stocklang';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'ml'        => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => Lang::getDefaultLang()->url,
                'langForeignKey'  => 'stock_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
        ]);
    }

    /**
     * Init multilingual fields
     */
    public function init()
    {
        $this->multiLanguageFields = ['title', 'content'];
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['content']);
        return [
            [['created_at', 'updated_at', 'enabled', 'sort'], 'integer'],
            [$safe, 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = [
            'id'         => Module::t('Id'),
            'created_at' => Module::t('Createdat'),
            'updated_at' => Module::t('Updatedat'),
            'enabled'    => Module::t('Enabled'),
            'sort'       => Module::t('Sort'),
            'title'      => Module::t('Title'),
            'content'    => Module::t('Text')
        ];
        return $this->formMultilingualLabels($labels);
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Stock',
            'multiple' => 'Stocks'
        ];
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        $fieldName = self::getMultiAttributeName('title', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        $fieldName = self::getMultiAttributeName('content', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }

}
