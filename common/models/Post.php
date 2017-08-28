<?php

namespace common\models;

use backend\components\SiteHelper;
use backend\models\Category;
use backend\models\Characteristic;
use backend\models\MenuType;
use backend\models\Slider;
use backend\models\Stock;
use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $enabled
 * @property string $alias
 * @property string $template
 * @property integer $default
 *
 * @property PostLang[] $translations
 */
class Post extends Bean
{

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    const STATUS_DEFAULT = 1;

    const STATUS_UNDEFAULT = 0;

    /**
     * Url of the current post
     * @var string
     */
    private $url;

    protected $tableLang = 'postlang';

    /**
     * @return string
     */
    public function getUrl()
    {
        if ($this->default) {
            return FrontendHelper::formLink('');
        }
        return FrontendHelper::formLink('/' . $this->alias);
    }

    /**
     * Layouts for the posts
     * @var array
     */
    private static $templates = [
        'content'      => 'Common template',
        'content-wide' => 'Full-width template'
    ];

    /**
     * @return array
     */
    public static function getTemplates()
    {
        return self::$templates;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * Init function
     */
    public function init()
    {
        $this->multiLanguageFields = ['title', 'content'];
        $this->previewMode = true;
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
                'langForeignKey'  => 'post_id',
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
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $required = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['content']);
        $rules = [
            [['enabled', 'default'], 'integer'],
            [$required, 'safe'],
            [['alias', 'template'], 'safe']
        ];

        return $rules;
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
            'title'      => Module::t('Title'),
            'content'    => Module::t('Text'),
            'alias'      => Module::t('Alias'),
            'default'    => Module::t('Default page')
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
            'singular' => 'Post',
            'multiple' => 'Posts'
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

    /**
     * @param $alias
     * @param $ignoreStatus
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function findByAlias($alias, $ignoreStatus = null)
    {
        $where = [
            'alias' => $alias,
        ];
        if (!isset($ignoreStatus)) {
            $where['enabled'] = self::STATUS_ENABLED;
        }
        $post = self::find()->localized(Lang::getCurrent()->url)->where($where)->one();
        if (empty($post)) {
            throw new NotFoundHttpException();
        }
        return $post;
    }

    /**
     * @throws NotFoundHttpException
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findDefaultPage()
    {
        $post = self::find()->localized(Lang::getCurrent()->url)->where([
            'default' => self::STATUS_DEFAULT
        ])->one();
        if (empty($post)) {
            throw new NotFoundHttpException();
        }
        return $post;
    }


    /**
     * @return array
     */
    public function loadDataInfo()
    {
        $posts = [];
        $response = [];
        $aliases = ['about-us', 'clothes-take-care', 'table-sizes'];
        foreach ($aliases as $alias) {
            $posts[] = self::findByAlias($alias, true);
        }
        $response['stocks'] = Stock::find()->orderBy('sort')->where([
            'enabled' => Stock::STATUS_ENABLED
        ])->all();
        $response['posts'] = $posts;
        return $response;
    }

    /**
     * @return array
     */
    public function loadDataMain()
    {
        $response = [];
        $slider = Slider::find()->where(['alias' => 'main-page'])->one();
        $response['slider'] = $slider;
        return $response;
    }

    /**
     * @return array
     */
    public function loadDataSitemap()
    {
        $response = [
            'data' => []
        ];

        /**
         * Load category data
         */
        $categoryCollection = Category::find()->where([
            'enabled' => Category::STATUS_ENABLED
        ])
            ->orderBy('sort')
            ->all();
        $categoryTree = SiteHelper::buildTreeArrayFromCollection($categoryCollection, 'id');
        $response['data'][] = [
            'title' => Module::t('Assortment'),
            'items' => $categoryTree,
        ];


        /**
         * Load shop data
         */
        /**
         * @var MenuType $menuTopType
         */
        $menuTopType = MenuType::find()->where([
            'alias' => MenuType::TYPE_HEADER
        ])->one();
        $menuCollection = Menu::findAllWithTitle(null, $menuTopType->id);
        $menuTree = SiteHelper::buildTreeArrayFromCollection($menuCollection, 'id');
        $mainPage = [
            'title' => Module::t('Main page'),
            'url'   => '/',
        ];
        array_unshift($menuTree, $mainPage);
        $response['data'][] = [
            'title' => Module::t('Internet-shop'),
            'items' => $menuTree,
        ];

        /**
         * Load useful information
         */
        $menuFooterType = MenuType::find()->where([
            'alias' => MenuType::TYPE_FOOTER
        ])->one();
        $menuCollection = Menu::findAllWithTitle(null, $menuFooterType->id);
        $menuTree = SiteHelper::buildTreeArrayFromCollection($menuCollection, 'id');
        $response['data'][] = [
            'title' => Module::t('Useful Information'),
            'items' => $menuTree,
        ];


        return $response;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->default == self::STATUS_DEFAULT) {
            \Yii::$app->db->createCommand()
                ->update(self::tableName(), [
                    'default' => self::STATUS_UNDEFAULT
                ], 'id <> ' . $this->id
                )->execute();
        }
    }


}
