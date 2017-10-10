<?php

namespace common\models;

use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "novelty".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $photo
 * @property integer $enabled
 *
 */
class Novelty extends Bean
{

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    const LIMIT = 10;

    protected $tableLang = 'novelty_lang';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'novelty';
    }

    /**
     * Init function
     */
    public function init()
    {
        $this->multiLanguageFields = ['title', 'description'];
        parent::init();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'ml'        => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => Lang::getDefaultLang()->url,
                'langForeignKey'  => 'novelty_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['description']);
        return [
            [['created_at', 'updated_at', 'enabled'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [$safe, 'safe']
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'title', 'description', 'photo', 'created_at'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Module::t('Id'),
            'created_at' => Module::t('Createdat'),
            'updated_at' => Module::t('Updatedat'),
            'photo'      => Module::t('Image'),
            'enabled'    => Module::t('Enabled'),
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
            'singular' => 'Novelty',
            'multiple' => 'News'
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLastNovelties()
    {
        return self::find()
            ->where([
                'enabled' => self::STATUS_ENABLED
            ])
            ->orderBy(['id' => SORT_DESC])
            ->limit(self::LIMIT)
            ->all();
    }

    /**
     * @param $noveltyID
     * @return int|string
     */
    public static function getUnreadCount($noveltyID)
    {
        /**
         * @var self[] $lastNovelties
         */
        $lastNovelties = self::getLastNovelties();
        $count = 0;
        foreach ($lastNovelties as $novelty) {
            if ($novelty->id > $noveltyID) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        $fieldName = self::getMultiAttributeName('title', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }


}
