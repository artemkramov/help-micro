<?php

namespace common\models;

use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $phone
 */
class Setting extends Bean
{

    /**
     * @var string
     */
    protected $tableLang = 'settinglang';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * Initialize multilingual fields
     */
    public function init()
    {
        $this->multiLanguageFields = ['table_size', 'seo_category_description', 'product_delivery_description'];
        parent::init();
    }

    /**
     * Behaviors of the model
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'ml' => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => Lang::getDefaultLang()->url,
                'langForeignKey'  => 'setting_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = ArrayHelper::merge($multiLanguageNames['table_size'], $multiLanguageNames['seo_category_description'], $multiLanguageNames['product_delivery_description']);
        return [
            [['phone'], 'required'],
            [['phone'], 'string', 'max' => 255],
            [$safe, 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                           => Module::t('Id'),
            'phone'                        => Module::t('Phone'),
            'table_size'                   => Module::t('Table size'),
            'seo_category_description'     => Module::t('Seo category description'),
            'product_delivery_description' => Module::t('Product delivery description')
        ];
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Settings',
            'multiple' => 'Settings'
        ];
    }


}
