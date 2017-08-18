<?php

namespace common\models;

use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $alias
 */
class BlogCategory extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @var string
     */
    protected $tableLang = 'blog_categorylang';

    /**
     * Init multilingual fields
     */
    public function init()
    {
        $this->multiLanguageFields = ['title'];
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = $multiLanguageNames['title'];
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 255],
            [$safe, 'safe']
        ];
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
                'langForeignKey'  => 'blog_category_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
            'slug'      => [
                'class'        => 'common\\behaviors\\Alias',
                'inAttribute'  => 'title',
                'outAttribute' => 'alias',
            ]
        ]);
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
            'alias'      => Module::t('Alias'),
            'title'      => Module::t('Title')
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
            'singular' => 'Blog category',
            'multiple' => 'Blog categories'
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $path = '/blog/' . $this->alias;
        return $path;
    }

    /**
     * @param $alias
     * @return BlogCategory
     * @throws NotFoundHttpException
     */
    public static function getCategoryByAlias($alias)
    {
        /**
         * @var BlogCategory $blogCategory
         */
        $blogCategory = self::find()->where([
            'alias' => trim($alias)
        ])->one();
        if (empty($blogCategory)) {
            throw new NotFoundHttpException();
        }
        return $blogCategory;
    }
}
