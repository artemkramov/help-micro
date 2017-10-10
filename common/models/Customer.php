<?php

namespace common\models;

use common\modules\i18n\Module;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $email
 * @property string $serial
 * @property string $DIC
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $version_dwl
 * @property integer $version_firmware
 */
class Customer extends Bean
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'serial'], 'required'],
            [['created_at', 'updated_at', 'version_dwl', 'version_firmware'], 'integer'],
            [['email', 'serial', 'DIC'], 'string', 'max' => 255],
            ['email', 'unique', 'targetAttribute' => ['email', 'serial', 'DIC']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Module::t('Id'),
            'email'      => 'Email',
            'serial'     => Module::t('Serial'),
            'DIC'        => Module::t('Dic'),
            'created_at' => Module::t('Createdat'),
            'updated_at' => Module::t('Updatedat'),
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return ['id', 'email', 'serial', 'DIC', 'version_dwl', 'version_firmware'];
    }

    /**
     * Method for getting the name of the bean
     * Is called for breadcrumb generation
     * @return array
     */
    public static function getLabels()
    {
        return [
            'singular' => 'Customer',
            'multiple' => 'Customers'
        ];
    }

    /**
     * @param $serialNumber
     * @throws NotFoundHttpException
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findBySerial($serialNumber)
    {
        /**
         * @var Customer $customer
         */
        $customer = self::find()
            ->where([
                'serial' => $serialNumber
            ])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        if (!isset($customer->id)) {
            throw new NotFoundHttpException();
        }
        return $customer;
    }
}
