<?php

namespace common\models;

use backend\behaviors\FileBehavior;
use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "blog_post".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $blog_category_id
 * @property string $image
 * @property string $alias
 * @property integer $enabled
 * @property integer $user_id
 *
 * @property BlogCategory $blogCategory
 * @property User $user
 */
class BlogPost extends Bean
{

    const STATUS_ENABLED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_post';
    }

    /**
     * @var mixed
     */
    public $fileImage;

    /**
     * @var string
     */
    protected $tableLang = 'blog_postlang';

    /**
     * Init multilingual fields
     */
    public function init()
    {
        $this->multiLanguageFields = ['title', 'content', 'short_description'];
        parent::init();
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'ml'        => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => Lang::getDefaultLang()->url,
                'langForeignKey'  => 'blog_post_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
            'slug'      => [
                'class'        => 'common\\behaviors\\Alias',
                'inAttribute'  => 'title',
                'outAttribute' => 'alias',
            ],
            'file'      => [
                'class'          => FileBehavior::className(),
                'fileAttributes' => [
                    'image' => 'fileImage'
                ],
                'folderName'     => 'blog-posts/images',
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['content'], $multiLanguageNames['short_description']);
        return [
            [['enabled'], 'required'],
            [['created_at', 'updated_at', 'blog_category_id', 'enabled'], 'integer'],
            [['image', 'alias'], 'string', 'max' => 255],
            [['blog_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['blog_category_id' => 'id']],
            [$safe, 'safe']
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (empty($this->user_id)) {
            $this->user_id = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'               => Module::t('Id'),
            'created_at'       => Module::t('Createdat'),
            'updated_at'       => Module::t('Updatedat'),
            'blog_category_id' => Module::t('Blog category'),
            'alias'            => Module::t('Alias'),
            'image'            => Module::t('Image'),
            'enabled'          => Module::t('Enabled')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'blog_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Blog post',
            'multiple' => 'Blog posts'
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $path = $this->blogCategory->getUrl() . '/' . $this->alias;
        return FrontendHelper::formLink($path);
    }

    /**
     * @return string
     */
    public function getDefaultImage()
    {
        if (!empty($this->image)) {
            return $this->image;
        } else {
            return FrontendHelper::getDefaultImage();
        }
    }

    /**
     * @param $alias
     * @return BlogPost
     * @throws NotFoundHttpException
     */
    public static function getPostByAlias($alias)
    {
        /**
         * @var BlogPost $blogPost
         */
        $blogPost = self::find()->where([
            'alias'   => trim($alias),
            'enabled' => self::STATUS_ENABLED
        ])->one();
        if (empty($blogPost)) {
            throw new NotFoundHttpException();
        }
        return $blogPost;
    }
}
