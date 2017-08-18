<?php

namespace common\models;

use backend\behaviors\FileBehavior;
use backend\components\SiteHelper;
use backend\models\MenuType;
use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use frontend\components\FrontendUrl;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort
 * @property integer $parent_id
 * @property string $bean_type
 * @property integer $bean_id
 * @property string $url
 * @property integer $enabled
 * @property integer $menu_type_id
 * @property string $image
 * @property integer $is_direct
 * @property integer $is_new_tab
 *
 * @property Menulang[] $menulangs
 * @property MenuType $menuType
 */
class Menu extends Bean
{

    const SCENARIO_SORT = 'sort';

    const EMPTY_LINK = 'javascript:void(0)';

    /**
     * Check if the url is manually entered
     * @var bool
     */
    public $isCustomUrl = false;

    /**
     * @var string
     */
    protected $tableLang = 'menulang';

    /**
     * @var mixed
     */
    public $fileImage;

    /**
     * Initialize multilingual fields
     */
    public function init()
    {
        $this->multiLanguageFields = ['title', 'description'];
        parent::init();
    }

    /**
     * Behaviors of the model
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            TimestampBehavior::className(),
            'ml' => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => Lang::getDefaultLang()->url,
                'langForeignKey'  => 'menu_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
            'file'      => [
                'class'          => FileBehavior::className(),
                'fileAttributes' => [
                    'image' => 'fileImage',
                ],
                'folderName'     => 'menu/images',
            ],
        ]);
    }

    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_DEFAULT => [
                'created_at', 'updated_at', 'parent_id', 'bean_id', 'bean_type', 'url', 'enabled', 'menu_type_id', 'is_direct', 'is_new_tab'
            ],
            self::SCENARIO_SORT    => ['sort'],
        ]);
    }

    /**
     * After find event
     */
    public function afterFind()
    {
        parent::afterFind();
        if (isset($this->url)) {
            $this->isCustomUrl = true;
        }
    }

    /**
     * Before save event
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!$this->isCustomUrl) {
            $this->url = null;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $required = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['description']);
        return [
            [['created_at', 'updated_at', 'sort', 'parent_id', 'bean_id', 'enabled', 'menu_type_id', 'is_direct', 'is_new_tab'], 'integer'],
            [['bean_type', 'url', 'image'], 'string', 'max' => 255],
            [['isCustomUrl'], 'safe'],
            [$required, 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = [
            'id'           => Module::t('Id'),
            'created_at'   => Module::t('Createdat'),
            'updated_at'   => Module::t('Updatedat'),
            'sort'         => Module::t('Sort'),
            'parent_id'    => Module::t('Parent menu'),
            'bean_type'    => Module::t('Bean type'),
            'bean_id'      => Module::t('Bean'),
            'url'          => 'Url',
            'title'        => Module::t('Title'),
            'description'  => Module::t('Text'),
            'isCustomUrl'  => Module::t('Enter the URL manually:'),
            'enabled'      => Module::t('Enabled'),
            'menu_type_id' => Module::t('Menu type'),
            'image'        => Module::t('Image'),
            'is_direct'    => Module::t('Direct link'),
            'is_new_tab'   => Module::t('New tab')
        ];
        return $this->formMultilingualLabels($labels);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenulangs()
    {
        return $this->hasMany(Menulang::className(), ['menu_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuType()
    {
        return $this->hasOne(MenuType::className(), [
            'id' => 'menu_type_id'
        ]);
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Menu',
            'multiple' => 'Menu'
        ];
    }

    /**
     * @return string
     */
    public function getPostTitle()
    {
        $fieldName = self::getMultiAttributeName('title', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }

    /**
     * @param int $excludeID
     * @param $menuTypeID
     * @return array
     */
    public static function getMenuDropdown($excludeID, $menuTypeID = null)
    {
        $menuCollection = Menu::findAllWithTitle($excludeID, $menuTypeID);
        $menuTree = SiteHelper::buildTreeArrayFromCollection($menuCollection, 'id');
        return SiteHelper::buildTreeDropdown($menuTree, 'id', 'title');
    }

    /**
     * Save the menu structure based on the JSON string
     * @param string $jsonTree
     */
    public static function saveMenuTree($jsonTree)
    {
        $collection = json_decode($jsonTree);
        if (is_array($collection)) {
            self::saveTree($collection);
        }
    }

    /**
     * Save menu data by the given collection
     * @param array $collection
     * @param null|integer $parentID
     */
    public static function saveTree($collection, $parentID = null)
    {
        foreach ($collection as $key => $item) {
            $menuItem = self::findOne($item->id);
            $menuItem->scenario = self::SCENARIO_SORT;
            $menuItem->sort = $key;
            $menuItem->parent_id = $parentID;
            $menuItem->save();
            if (isset($item->children) && !empty($item->children)) {
                self::saveTree($item->children, $item->id);
            }
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        $url = $this->url;
        if (!isset($url)) {
            $post = Post::findOne($this->bean_id);
            if (!empty($post)) {
                $url = FrontendHelper::formLink('/' . $post->alias);
            }
        } else {
            if ($url != self::EMPTY_LINK) {
                $url = !$this->is_direct ? FrontendHelper::formLink('/' . $url) : $url;
            }
            else {
                return $url;
            }
        }
        return isset($url) ? FrontendUrl::to($url) : '';
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


}
