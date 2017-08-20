<?php

namespace backend\models;

use backend\behaviors\FileBehavior;
use backend\components\ManyToManyBehavior;
use backend\components\SiteHelper;
use common\behaviors\Alias;
use common\components\MultilingualBehavior;
use common\components\Number;
use common\models\Bean;
use common\models\Lang;
use common\models\PreOrder;
use common\models\Sale;
use common\models\SaleProduct;
use common\models\User;
use common\modules\i18n\Module;
use frontend\components\FrontendHelper;
use frontend\components\SearchSite;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $enabled
 * @property string $vendor_code
 * @property integer $sort
 * @property double $price
 * @property integer $in_stock
 * @property string $alias
 * @property string $type
 * @property integer $currency_id
 * @property string $video
 * @property integer $is_new
 * @property string $image_color
 * @property string $buy_link
 *
 * @property Category[] $categories
 * @property ProductVariation[] $variations
 * @property ProductGallery[] $images
 * @property ProductFile[] $files
 */
class Product extends Bean
{

    const TABLE_PRODUCT_CATEGORY = 'product_category';

    const TABLE_PRODUCT_CHARACTERISTIC = 'product_characteristic';

    const TABLE_USER_FAVOURITE = 'user_favourite';

    const STATUS_ENABLED = 1;

    const STATUS_IS_NEW = 1;

    const TYPE_VARIATION = 'variation';

    /**
     * @var array
     */
    public $product_ids = [];

    /**
     * @var array
     */
    public $properties = [];

    /**
     * @var mixed
     */
    public $fileVideo;

    /**
     * @var mixed
     */
    public $fileImage;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @var string
     */
    public $tableLang = 'productlang';

    public function init()
    {
        $this->multiLanguageFields = ['title', 'content', 'short_description', 'size_fit', 'editor_notes', 'table_size'];
        $this->type = 'simple';
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
                'langForeignKey'  => 'product_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
            'category'  => [
                'class'     => ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
            'file'      => [
                'class'          => FileBehavior::className(),
                'fileAttributes' => [
                    'image_color' => 'fileImage',
                ],
                'folderName'     => 'products/icons',
            ],
        ]);
    }


    public function getCategories()
    {
        return $this->hasMany(Category::className(), [
            'id' => 'category_id'
        ])->viaTable(self::TABLE_PRODUCT_CATEGORY, ['product_id' => 'id'])->orderBy(['level' => SORT_DESC]);
    }

    public function getVariations()
    {
        return $this->hasMany(ProductVariation::className(), [
            'product_id' => 'id'
        ]);
    }

    public function getImages()
    {
        return $this->hasMany(ProductGallery::className(), [
            'product_id' => 'id'
        ])->orderBy('sort');
    }

    public function getFiles()
    {
        return $this->hasMany(ProductFile::className(), [
            'product_id' => 'id'
        ])->orderBy('sort');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $safe = ArrayHelper::merge($multiLanguageNames['title'], $multiLanguageNames['content'],
            $multiLanguageNames['short_description'], $multiLanguageNames['size_fit'],
            $multiLanguageNames['editor_notes'], $multiLanguageNames['table_size'], ['properties']);
        return [
            [['vendor_code', 'price', 'buy_link'], 'required'],
            [['created_at', 'updated_at', 'enabled', 'sort', 'in_stock', 'currency_id', 'is_new'], 'integer'],
            [['price'], 'number'],
            [['vendor_code', 'alias', 'type', 'buy_link', 'video', 'image_color'], 'string', 'max' => 255],
            [$safe, 'safe'],
            [['category_ids'], 'each', 'rule' => ['integer']],
            ['variations', 'validateRelatedBeans', 'skipOnEmpty' => false, 'skipOnError' => false, 'params' => ['beanRelatedField' => 'product_id', 'beanClass' => ProductVariation::className()]],
            ['images', 'validateRelatedBeans', 'skipOnEmpty' => false, 'skipOnError' => false, 'params' => ['beanRelatedField' => 'product_id', 'beanClass' => ProductGallery::className()]],
            ['files', 'validateRelatedBeans', 'skipOnEmpty' => false, 'skipOnError' => false, 'params' => ['beanRelatedField' => 'product_id', 'beanClass' => ProductFile::className()]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => Module::t('Id'),
            'created_at'        => Module::t('Createdat'),
            'updated_at'        => Module::t('Updatedat'),
            'enabled'           => Module::t('Enabled'),
            'vendor_code'       => Module::t('Vendor code'),
            'sort'              => Module::t('Sort'),
            'price'             => Module::t('Price'),
            'in_stock'          => Module::t('In stock'),
            'alias'             => Module::t('Alias'),
            'title'             => Module::t('Title'),
            'content'           => Module::t('Text'),
            'category_ids'      => Module::t('Categories'),
            'type'              => Module::t('Type'),
            'currency_id'       => Module::t('Currency'),
            'short_description' => Module::t('Short description'),
            'video'             => Module::t('Video'),
            'is_new'            => Module::t('Latest'),
            'size_fit'          => Module::t('Size & fit information'),
            'editor_notes'      => Module::t('Editor notes'),
            'image_color'       => Module::t('Icon'),
            'fileImage'         => Module::t('Icon'),
            'table_size'        => Module::t('Table size'),
            'buy_link'          => Module::t('Buy link')
        ];
    }

    /**
     * @return mixed
     */
    public function getProductTitle()
    {
        $fieldName = self::getMultiAttributeName('title', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }

    /**
     * @return mixed
     */
    public function getProductContent()
    {
        $fieldName = self::getMultiAttributeName('content', Lang::getCurrent()->url);
        return $this->{$fieldName};
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Product',
            'multiple' => 'Products'
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $aliasBehavior = new Alias();
        $aliasBehavior->inAttribute = 'title';
        $aliasBehavior->outAttribute = 'alias';
        $aliasBehavior->owner = $this;
        if (empty($this->alias)) {
            $colorPart = '';
            if (array_key_exists('color', $this->properties) && is_array($this->properties['color'])) {
                foreach ($this->properties['color'] as $characteristicID) {
                    $color = Characteristic::find()->localized('en')->where(['id' => $characteristicID])->one();
                    $colorPart .= strtolower($color->title);
                }
            }
            if (!empty($colorPart)) {
                $colorPart .= '-';
            }
            $this->alias = $aliasBehavior->generateAlias($this->title) . '-' . $colorPart . $this->vendor_code;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return string
     */
    public function getCategoriesList()
    {
        $list = ArrayHelper::map($this->categories, 'id', 'title');
        return implode($list, '; ');
    }

    /**
     * Load custom attributes to the product
     */
    public function afterFind()
    {
        parent::afterFind();
        /**
         * Fetch all custom attributes of the product
         */
        $groups = CharacteristicGroup::getAllRecords();
        foreach ($groups as $group) {
            $alias = $group->alias;
            $data = (new Query())
                ->select('characteristic_id')
                ->from(self::TABLE_PRODUCT_CHARACTERISTIC)
                ->join('inner join', Characteristic::tableName(), Characteristic::tableName() . '.id = ' . self::TABLE_PRODUCT_CHARACTERISTIC . '.characteristic_id')
                ->join('inner join', CharacteristicGroup::tableName(), CharacteristicGroup::tableName() . '.id = ' . Characteristic::tableName() . '.characteristic_group_id')
                ->where([
                    CharacteristicGroup::tableName() . '.alias' => $alias,
                    'product_id'                                => $this->id
                ])
                ->all();
            $result = [];
            if (!empty($data)) {
                $result = ArrayHelper::getColumn($data, 'characteristic_id');
            }
            $this->properties[$alias] = $result;
        }
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $postData = \Yii::$app->request->post();
        if ($this->type == 'simple' || !array_key_exists('variations', $postData['Product'])) {
            ProductVariation::deleteAll(['product_id' => $this->id]);
        }
        if ($insert) {
            $variationData = array_key_exists('variations', $postData['Product']) ? $postData['Product']['variations'] : [];
            $this->setVariations($variationData);
        }
        $errors = $this->setImages($postData);
        if (!empty($errors)) {
            \Yii::$app->session->setFlash('error', implode(',', $errors));
        }
        $errors = $this->setFiles($postData);
        if (!empty($errors)) {
            \Yii::$app->session->setFlash('error', implode(',', $errors));
        }
        /**
         * Save all custom characteristics of the product
         */
        \Yii::$app->db->createCommand()->delete(self::TABLE_PRODUCT_CHARACTERISTIC, [
            'product_id' => $this->id
        ])->execute();
        foreach ($this->properties as $alias => $data) {
            if (!empty($data)) {
                foreach ($data as $characteristicID) {
                    $insertData = [
                        'product_id'        => $this->id,
                        'characteristic_id' => $characteristicID
                    ];
                    \Yii::$app->db->createCommand()->insert(self::TABLE_PRODUCT_CHARACTERISTIC, $insertData)->execute();
                }
            }
        }
        /**
         * Save all information about the product to the search column
         */
        $this->saveSearchInformation();

        /**
         * Update all pre-order information related to this product
         */
        if ($this->isInStock()) {
            /**
             * @var PreOrder[] $requests
             */
            $requests = PreOrder::find()->where([
                'product_id' => $this->id,
                'status'     => PreOrder::STATUS_CONCEPT
            ])->all();
            foreach ($requests as $request) {
               if ($this->isSizeInStock($request->size_id)) {
                   $request->status = PreOrder::STATUS_ACCEPTED;
                   $request->save();
               }
            }
        }

    }

    /**
     * Save search information to the product data
     */
    private function saveSearchInformation()
    {
        foreach (Lang::getLanguages() as $language) {
            $searchText = '';
            /**
             * @var Lang $language
             */
            $row = (new Query())
                ->select('*')
                ->from($this->tableLang)
                ->where([
                    'language'   => $language->url,
                    'product_id' => $this->id,
                ])
                ->one();
            if (!empty($row)) {

                /**
                 * Get information from properties
                 */
                if (is_array($this->properties)) {
                    foreach ($this->properties as $propertyData) {
                        if (!is_array($propertyData)) continue;
                        foreach ($propertyData as $itemID) {
                            $characteristic = Characteristic::find()->localized($language->url)->where([
                                'id' => $itemID
                            ])->one();
                            $searchText .= ' ' . $characteristic->title;
                        }
                    }
                }
                if (!empty($this->categories)) {
                    $list = [];
                    foreach ($this->categories as $category) {
                        $localized = Category::find()->where([
                            'id' => $category->id,
                        ])->localized($language->url)->one();
                        $list[] = $localized->title;
                    }
                    $searchText .= ' ' . implode(' ', $list);
                }

                /**
                 * Get information from fields
                 */
                $fields = ['title', 'content', 'short_description'];
                foreach ($fields as $field) {
                    /**
                     * Remove all html tags from the string
                     */
                    $fieldData = preg_replace('/<[^>]*>/', ' ', $row[$field]);
                    $searchText .= ' ' . $fieldData;
                }

                /**
                 * Remove line breaks
                 */
                $searchText = preg_replace("/\r|\n/", " ", trim($searchText));

                /**
                 * Remove duplicates
                 */
                $searchText = mb_strtoupper(implode(' ', array_slice(array_unique(explode(' ', $searchText)), 0, 100)), 'utf-8');

                \Yii::$app->db->createCommand()->update($this->tableLang, [
                    'search_text' => $searchText,
                ], [
                    'id' => $row['id']
                ])->execute();
            }
        }
    }

    /**
     * @param $alias
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCustomAttributesByAlias($alias)
    {
        $collection = Characteristic::find()
            ->join('inner join', CharacteristicGroup::tableName(), CharacteristicGroup::tableName() . '.id = ' . Characteristic::tableName() . '.characteristic_group_id')
            ->where([
                CharacteristicGroup::tableName() . '.alias' => $alias
            ])
            ->orderBy('sort')
            ->all();
        return $collection;
    }

    /**
     * @return array
     */
    public static function getTypeList()
    {
        return [
            'simple'    => Module::t('Simple product'),
            'variation' => Module::t('Variation'),
        ];
    }

    /**
     * @param $postData
     */
    public function setVariations($postData)
    {
        ProductVariation::deleteAll(['product_id' => $this->id]);
        $data = $this->bundleMultipleBean(ProductVariation::className(), $postData);

        foreach ($data['items'] as $bean) {
            $bean->product_id = $this->id;
            $bean->save();
        }
    }

    /**
     * @param $postData
     * @return array
     */
    public function setImages($postData)
    {
        ProductGallery::deleteAll(['product_id' => $this->id]);
        $files = UploadedFile::getInstancesByName('file');
        $uploadFolder = self::getUploadFolder();
        $errors = [];
        if (!empty($postData)) {
            $data = array_key_exists('ProductGallery', $postData) ? $postData['ProductGallery'] : [];
            $counter = 0;
            foreach ($data as $key => $beanArray) {
                $bean = new ProductGallery();
                if (array_key_exists('image', $beanArray)) {
                    $bean->image = $beanArray['image'];
                } else {
                    /**
                     * Load image
                     */
                    if (!array_key_exists($counter, $files)) continue;
                    $file = $files[$counter];
                    $baseName = SiteHelper::translit($file->baseName);
                    $relativePath = $uploadFolder['relativePath'] . $baseName . "." . $file->extension;
                    $path = $uploadFolder['path'] . $baseName . "." . $file->extension;
                    $thumbPath = $uploadFolder['thumb'] . $baseName . "." . $file->extension;
                    $cardPath = $uploadFolder['card'] . $baseName . "." . $file->extension;
                    $isSuccess = $file->saveAs($path);
                    if ($isSuccess) {
                        Image::thumbnail($path, 400, 600)->save($thumbPath, ['quality' => 100]);
                        Image::thumbnail($path, 390, 585)->save($cardPath, ['quality' => 100]);
                        $bean->image = $relativePath;
                    }
                    $counter++;
                }
                $bean->sort = $beanArray['sort'];
                $bean->product_id = $this->id;
                $bean->save();
            }
        }
        return $errors;
    }

    /**
     * @param $postData
     * @return array
     */
    public function setFiles($postData)
    {
        ProductFile::deleteAll(['product_id' => $this->id]);
        $files = UploadedFile::getInstancesByName('document');
        $uploadFolder = self::getUploadFolder();
        $errors = [];
        if (!empty($postData)) {
            $data = array_key_exists('ProductFile', $postData) ? $postData['ProductFile'] : [];
            $counter = 0;
            foreach ($data as $key => $beanArray) {
                $bean = new ProductFile();
                if (array_key_exists('document', $beanArray)) {
                    $bean->file = $beanArray['document'];
                } else {
                    /**
                     * Load file
                     */
                    if (!array_key_exists($counter, $files)) continue;
                    $file = $files[$counter];
                    $baseName = SiteHelper::translit($file->baseName);
                    $relativePath = $uploadFolder['relativePath'] . 'file/' . $baseName . "." . $file->extension;
                    $path = $uploadFolder['file'] . $baseName . "." . $file->extension;
                    $isSuccess = $file->saveAs($path);
                    if ($isSuccess) {
                        $bean->file = $relativePath;
                    }
                    $counter++;
                }
                $bean->sort = $beanArray['sort'];
                $bean->name = $beanArray['name'];
                $bean->product_id = $this->id;
                $bean->save();
            }
        }
        return $errors;
    }

    /**
     * Get directory where customer's file is saved
     * @return string
     * @throws Exception
     */
    public function getUploadFolder()
    {
        $id = $this->id;
        $basePath = \Yii::getAlias('@frontend') . '/web';
        $relativePath = "/uploads/products/" . $id . "/";
        $thumbPath = $basePath . $relativePath . 'thumb/';
        $cardPath = $basePath . $relativePath . 'card/';
        $filePath = $basePath . $relativePath . 'file/';
        $path = [
            'path'         => $basePath . $relativePath,
            'relativePath' => $relativePath,
            'thumb'        => $thumbPath,
            'card'         => $cardPath,
            'file'         => $filePath
        ];
        BaseFileHelper::createDirectory($path['path']);
        /** Create thumbnail path */
        BaseFileHelper::createDirectory($path['thumb']);
        /** Create path for the image in the card */
        BaseFileHelper::createDirectory($path['card']);
        /** Create path for the file */
        BaseFileHelper::createDirectory($path['file']);
        return $path;
    }

    /**
     * @return string
     */
    public function getDefaultImage()
    {
        if (!empty($this->images)) {
            $images = $this->images;
            $defaultImage = reset($images);
            $baseName = basename($defaultImage->image);
            $thumbPath = dirname($defaultImage->image) . '/thumb/' . $baseName;
            if (file_exists(\Yii::getAlias('@frontend') . '/web' . $thumbPath)) {
                return $thumbPath;
            }
            return $defaultImage->image;
        } else {
            return FrontendHelper::getDefaultImage();
        }
    }

    /**
     * @return null|string
     */
    public function getFrontImage()
    {
        if (!empty($this->images)) {
            $images = $this->images;
            if (count($images) > 1) {
                /**
                 * Get the second image to display the alternate image
                 */
                $frontImage = $images[1];
                /**
                 * Get the thumbnail path
                 */
                $baseName = basename($frontImage->image);
                $thumbPath = dirname($frontImage->image) . '/thumb/' . $baseName;
                if (file_exists(\Yii::getAlias('@frontend') . '/web' . $thumbPath)) {
                    return $thumbPath;
                }
                return $frontImage->image;
            }
        }
        return null;
    }


    /**
     * @param bool $withoutDiscount
     * @return float
     */
    public function getProductPrice($withoutDiscount = false)
    {
        $toCurrency = Currency::getCurrentCurrency();
        $fromCurrency = Currency::findOne($this->currency_id);
        $action = !$withoutDiscount ? $this->getActionDiscount() : 0;
        $price = round($this->price * (1 - $action / 100));
        $price = Currency::convertPrice($price, $fromCurrency, $toCurrency);
        return $price;
    }

    /**
     * @param null $price
     * @param bool $withoutDiscount
     * @return string
     */
    public function getProductPriceFormatted($price = null, $withoutDiscount = false)
    {
        if (!isset($price)) {
            $price = $this->getProductPrice($withoutDiscount);
        }
        $toCurrency = Currency::getCurrentCurrency();
        $price = number_format($price, 0, Number::DECIMAL_SEPARATOR, Number::THOUSAND_SEPARATOR);
        return Currency::showFormattedPrice($price, $toCurrency);
    }

    /**
     * @return bool
     */
    public function isInStock()
    {
        $sizes = array_key_exists('size', $this->properties) ? $this->properties['size'] : [];
        foreach ($sizes as $sizeID) {
            if ($this->isSizeInStock($sizeID)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $sizeID
     * @return int|mixed
     */
    public function isSizeInStock($sizeID)
    {
        $size = Characteristic::findOne($sizeID);
        $row = ProductVariation::find()->where([
            'product_id'        => $this->id,
            'characteristic_id' => $size->id
        ])->one();
        return !empty($row) ? $row->in_stock : $this->in_stock;
    }

    /**
     * @param $alias
     * @param $previewMode
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function getProductByAlias($alias, $previewMode = false)
    {
        $query = self::find()->where([
            'alias'   => $alias
        ]);
        if (!$previewMode) {
            $query->andWhere([
                'enabled' => self::STATUS_ENABLED
            ]);
        }
        $product = $query->localized(Lang::getCurrent()->url)
            ->one();
        if (empty($product)) {
            throw new NotFoundHttpException();
        }
        return $product;
    }

    /**
     * @param $alias
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function getProductByAliasPart($alias)
    {
        $query = self::find()->where([
            'like', 'alias', $alias
        ]);
        $product = $query->localized(Lang::getCurrent()->url)
            ->one();
        if (empty($product)) {
            throw new NotFoundHttpException();
        }
        return $product;
    }

    /**
     * @param $path
     * @return string
     */
    public function getThumbnailPath($path)
    {
        $baseName = basename($path);
        $thumbPath = dirname($path) . '/thumb/' . $baseName;
        if (file_exists(\Yii::getAlias('@frontend') . '/web' . $thumbPath)) {
            return $thumbPath;
        }
    }

    /**
     * @param $path
     * @return string
     */
    public function getCardPath($path)
    {
        $baseName = basename($path);
        $thumbPath = dirname($path) . '/card/' . $baseName;
        if (file_exists(\Yii::getAlias('@frontend') . '/web' . $thumbPath)) {
            return $thumbPath;
        }
    }

    /**
     * @return array
     */
    public function getGalleryData()
    {
        $data = [
            'main'       => '',
            'thumbnails' => '',
            'large'      => '',
        ];
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $data['main'][] = $image->image;//$this->getCardPath($image->image);
                $data['thumbnails'][] = $this->getThumbnailPath($image->image);
                $data['large'][] = $image->image;
            }
        } else {
            $defaultImage = FrontendHelper::getDefaultImage();;
            $data['main'][] = $defaultImage;
            $data['thumbnails'][] = $defaultImage;
            $data['large'][] = $defaultImage;
        }
        return $data;
    }

    /**
     * @return array
     */
    public function getProductSizes()
    {
        return $this->properties['size'];
    }

    /**
     * @return null|\yii\db\ActiveRecord
     */
    public function getProductBrandDefault()
    {
        $brands = $this->properties['brand'];
        if (!empty($brands)) {
            $brandID = reset($brands);
            $brand = Characteristic::findOne($brandID);
            return $brand;
        }
        return null;
    }

    /**
     * @return string
     */
    public function getProductColor()
    {
        $colors = $this->properties['color'];
        if (!empty($colors)) {
            $colorID = reset($colors);
            $color = Characteristic::findOne($colorID);
            return $color->title;
        }
        return '';
    }

    /**
     * @return array
     */
    public function getProductSizesDropdown()
    {
        $data = [
            '' => Module::t('Choose your size')
        ];
        $sizes = $this->getProductSizes();
        foreach ($sizes as $sizeID) {
            $size = Characteristic::findOne($sizeID);
            $data[$sizeID] = $size->title;
        }
        return $data;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getKits()
    {
        $kits = Kit::find()
            ->join('inner join', Kit::TABLE_KIT_PRODUCT, Kit::TABLE_KIT_PRODUCT . '.kit_id = ' . Kit::tableName() . '.id')
            ->where([
                Kit::TABLE_KIT_PRODUCT . '.product_id' => $this->id
            ])
            ->distinct()
            ->all();
        return $kits;
    }

    /**
     * @param $type
     * @return string
     */
    public function getUrl($type = 'product')
    {
        if (!isset($type)) {
            $type = 'product';
        }
        return Url::to('/' . Lang::getCurrent()->url . '/' . $type . '/' . $this->alias);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getRelatedProducts()
    {
        $categories = $this->categories;
        usort($categories, function($a, $b) {
            /**
             * @var Category $a
             * @var Category $b
             */
            return $a->level < $b->level;
        });
        $relatedProductIds = ArrayHelper::getColumn(ProductRelation::find()->where([
            'product_id' => $this->id
        ])->all(), 'product_related_id');
        $relatedProducts = empty($relatedProductIds) ? [] : self::find()
            ->where([
                'in', 'id', $relatedProductIds
            ])
            ->andWhere([
                'enabled' => self::STATUS_ENABLED
            ])->all();
        $limit = 20;
        $limit = $limit > count($relatedProducts) ? $limit - count($relatedProducts) : 0;
        $categoryIds = ArrayHelper::getColumn($categories, 'id');
        $products = $relatedProducts;
        foreach ($categories as $category) {
            /**
             * @var Category $category
             */
            $items = self::find()->join('inner join', self::TABLE_PRODUCT_CATEGORY, self::TABLE_PRODUCT_CATEGORY . '.product_id = ' . self::tableName() . '.id')
                ->where(
                    self::TABLE_PRODUCT_CATEGORY . '.product_id <> ' . $this->id
                )
                ->andWhere([
                    'enabled' => self::STATUS_ENABLED
                ])
                ->andWhere(['in', self::TABLE_PRODUCT_CATEGORY . '.category_id', [$category->id]])
                ->distinct()
                ->limit($limit)
                ->all();
            $products += $items;
            $limit -= count($items);
            if ($limit <= 0) {
                break;
            }

        }
        return $products;
    }

    /**
     * @param integer $sizeID
     * @return string
     */
    public function getHash($sizeID)
    {
        return md5($this->id . 'size' . $sizeID);
    }

    /**
     * @param $sizeID
     * @param bool $format
     * @return float|string
     */
    public function getPricePerUnit($sizeID, $format = false)
    {
        $price = $this->price;
        $currency = Currency::findOne($this->currency_id);
        if ($this->type == self::TYPE_VARIATION) {
            $record = ProductVariation::find()
                ->where([
                    'product_id'        => $this->id,
                    'characteristic_id' => $sizeID,
                ])
                ->one();
            if (!empty($record)) {
                $price = $record['price'];
                $currency = Currency::findOne($record['currency_id']);
            }
        }
        $discount = $this->getActionDiscount();
        $price = round($price * (1 - $discount / 100));
        $commonPrice = Currency::convertToDefaultCurrency($price, $currency);
        if ($format) {
            return Currency::showPrice($commonPrice);
        } else {
            return $commonPrice;
        }
    }

    /**
     * @param $sizeID
     * @param $count
     * @param bool $format
     * @return string
     */
    public function getPriceTotal($sizeID, $count, $format = false)
    {
        $price = $count * $this->getPricePerUnit($sizeID);
        if ($format) {
            return Currency::showPrice($price);
        } else {
            return $price;
        }
    }

    /**
     * @param $productID
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public static function getProductByID($productID)
    {
        $product = Product::find()
            ->where([
                'id'      => $productID,
                'enabled' => Product::STATUS_ENABLED,
            ])
            ->one();
        if (empty($product)) {
            throw new NotFoundHttpException();
        }
        return $product;
    }

    /**
     * @return array
     */
    public function addToFavourite()
    {
        /**
         * @var User $user
         */
        $user = \Yii::$app->user->identity;
        $row = (new Query())
            ->select('*')
            ->from(self::TABLE_USER_FAVOURITE)
            ->where([
                'product_id' => $this->id,
                'user_id'    => $user->id,
            ])
            ->one();
        if (empty($row)) {
            \Yii::$app->db->createCommand()
                ->insert(self::TABLE_USER_FAVOURITE, [
                    'product_id' => $this->id,
                    'user_id'    => $user->id,
                ])
                ->execute();
        }

        return [
            'success' => true,
        ];
    }

    /**
     * @return array
     */
    public function removeFromFavourite()
    {
        \Yii::$app->db->createCommand()
            ->delete(self::TABLE_USER_FAVOURITE, [
                'user_id'    => \Yii::$app->user->id,
                'product_id' => $this->id,
            ])
            ->execute();
        return [
            'success' => true
        ];
    }

    /**
     * @param $collectionID
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getProductsByCollection($collectionID)
    {
        return Product::find()
            ->join('inner join', self::TABLE_PRODUCT_CHARACTERISTIC, self::TABLE_PRODUCT_CHARACTERISTIC . '.product_id = ' . self::tableName() . '.id')
            ->where([
                self::TABLE_PRODUCT_CHARACTERISTIC . '.characteristic_id' => $collectionID
            ])
            ->distinct()
            ->all();
    }

    /**
     * @param boolean $count
     * @return array
     */
    public static function getProductIdsWithAction($count = false)
    {
        $items = self::find()
            ->join('inner join', SaleProduct::tableName(), SaleProduct::tableName() . '.product_id = ' . self::tableName() . '.id')
            ->join('inner join', Sale::tableName(), Sale::tableName() . '.id = ' . SaleProduct::tableName() . '.sale_id')
            ->where([
                Sale::tableName() . '.enabled' => Sale::STATUS_ENABLED,
            ])
            ->distinct();
        return !$count ? ArrayHelper::getColumn($items->all(), 'id') : $items->count();
    }

    /**
     * @param bool $count
     * @return array
     */
    public static function getProductIdsNovelties($count = false)
    {
        $query = self::find();
        self::isNoveltyCondition($query);
        $items = $query->distinct();
        return !$count ? ArrayHelper::getColumn($items->all(), 'id') : $items->count();
    }

    /**
     * @param string $alias
     * @return array
     */
    public static function getProductIdsCollection($alias)
    {
        $query = self::find();
        self::isInCollectionCondition($query, $alias);
        $items = $query->distinct()->all();
        return ArrayHelper::getColumn($items, 'id');
    }

    /**
     * @param ActiveQuery $query
     * @param $alias
     */
    public static function isInCollectionCondition($query, $alias)
    {
        $query->join('inner join', self::TABLE_PRODUCT_CHARACTERISTIC, self::TABLE_PRODUCT_CHARACTERISTIC . '.product_id = ' . self::tableName() . '.id')
            ->join('inner join', Characteristic::tableName(), Characteristic::tableName() . '.id = ' . self::TABLE_PRODUCT_CHARACTERISTIC . '.characteristic_id')
            ->andWhere([
                Characteristic::tableName() . '.alias' => $alias
            ]);
    }

    /**
     * @param ActiveQuery $query
     */
    public static function isNoveltyCondition($query)
    {
        $query->andWhere(
            self::tableName() . '.is_new =  ' . self::STATUS_IS_NEW . ' OR FROM_UNIXTIME(created_at) > NOW() - INTERVAL 4 WEEK'
        );
    }

    /**
     * @return bool
     */
    public function isNovelty()
    {
        $query = self::find();
        self::isNoveltyCondition($query);
        $row = $query->andWhere([
            'id' => $this->id
        ])
            ->distinct()
            ->one();
        return !empty($row);
    }

    /**
     * @return float|int
     */
    public function getActionDiscount()
    {
//        /**
//         * @var Sale $action
//         */
//        $action = Sale::find()
//            ->join('inner join', SaleProduct::tableName(), SaleProduct::tableName() . '.sale_id = ' . Sale::tableName() . '.id')
//            ->where([
//                SaleProduct::tableName() . '.product_id' => $this->id,
//                Sale::tableName() . '.enabled'           => Sale::STATUS_ENABLED,
//            ])
//            ->distinct()
//            ->orderBy(['percentage' => 'desc'])
//            ->one();
//        if (!empty($action)) {
//            return $action->percentage;
//        }
        return 0;
    }

    /**
     * @return array
     */
    public function getRelatedIcons()
    {
        $data = [];
        $products = Product::find()
            ->where([
                'enabled'     => self::STATUS_ENABLED,
                'vendor_code' => $this->vendor_code
            ])
            ->all();
        foreach ($products as $product) {
            /**
             * @var Product $product
             */
            if (!empty($product->image_color)) {
                $data[] = [
                    'icon'   => Url::to($product->image_color),
                    'link'   => $product->getUrl(),
                    'active' => $product->id == $this->id ? true : false,
                ];
            }
        }
        return $data;
    }

    /**
     * After delete hook
     */
    public function afterDelete()
    {
        \Yii::$app->db->createCommand()->delete($this->tableLang, [
            'product_id' => $this->id
        ])->execute();
        parent::afterDelete();
    }

    /**
     * Get the closest category
     * @return Category|mixed|null
     */
    public function getClosestCategory()
    {
        if (!empty($this->categories)) {
            $categories = $this->categories;
            $category = reset($categories);
            return $category;
        }
        return null;
    }


}
