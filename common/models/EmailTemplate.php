<?php

namespace common\models;

use common\components\Mailer;
use common\components\MultilingualBehavior;
use common\modules\i18n\Module;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "email_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $enabled
 * @property string $receivers
 * @property string $alias
 * @property integer $for_customer
 *
 */
class EmailTemplate extends Bean
{

    protected $tableLang = 'email_templatelang';

    const STATUS_ENABLED = 1;

    const ALIAS_NEW_ORDER = 'new-order';

    const ALIAS_PROCEEDING_ORDER = 'processing-order';

    const ALIAS_COMPLETED_ORDER = 'completed-order';

    const ALIAS_FORGET_PASSWORD = 'forget-password';

    const ALIAS_CONTACT_FORM = 'contact-form';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * Init function
     */
    public function init()
    {
        $this->multiLanguageFields = ['subject'];
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $multiLanguageNames = $this->formMultiLanguageFields();
        $required = $multiLanguageNames['subject'];
        return [
            [['name', 'description', 'enabled', 'alias'], 'required'],
            [['description', 'receivers'], 'string'],
            [['enabled'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
            [$required, 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => Module::t('Id'),
            'name'        => Module::t('Name'),
            'description' => Module::t('Description'),
            'enabled'     => Module::t('Enabled'),
            'receivers'   => Module::t('Receivers'),
            'alias'       => Module::t('Alias'),
            'subject'     => Module::t('Email subject')
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        /**
         * @var Lang $currentLanguage
         */
        $currentLanguage = Lang::getCurrent();
        return ArrayHelper::merge(parent::behaviors(), [
            'ml'        => [
                'class'           => MultilingualBehavior::className(),
                'defaultLanguage' => $currentLanguage->url,
                'langForeignKey'  => 'email_template_id',
                'tableName'       => "{{%" . $this->tableLang . "}}",
                'attributes'      => $this->multiLanguageFields,
            ],
        ]);
    }

    /**
     * @return mixed
     */
    public function getEmailSubject()
    {
        /**
         * @var Lang $currentLanguage
         */
        $currentLanguage = Lang::getCurrent();
        $fieldName = self::getMultiAttributeName('subject', $currentLanguage->url);
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
            'singular' => 'Email template',
            'multiple' => 'Email templates'
        ];
    }

    /**
     * @param Order $order
     * @return string
     */
    public function loadEmailBody($order)
    {
        $emailViewPath = \Yii::getAlias('@frontend/modules/page/views/default/emails/');
        \Yii::$app->controller->viewPath = $emailViewPath;
        $html = \Yii::$app->controller->renderPartial('main', [
            'template' => $this->alias,
            'data'     => [
                'order' => $order,
            ],
        ]);
        return $html;
    }

    /**
     * @param $content
     * @return string
     */
    public static function getBody($content)
    {
        $emailViewPath = \Yii::getAlias('@frontend/modules/shop/views/basket/emails/');
        \Yii::$app->controller->viewPath = $emailViewPath;
        $html = \Yii::$app->controller->renderPartial('main', [
            'template' => 'common',
            'data'     => [
                'content' => $content,
            ],
        ]);
        return $html;
    }

    /**
     * @param $alias
     * @param $order
     */
    public static function sendTemplateByAlias($alias, $order)
    {
        /**
         * @var EmailTemplate $template
         */
        $template = self::find()
            ->where([
                'enabled' => self::STATUS_ENABLED,
                'alias'   => $alias
            ])
            ->one();
        if (!empty($template)) {
            $template->sendEmail($order);
        }
    }

    /**
     * @param Order $order
     */
    public function sendEmail($order)
    {
        $emailBody = $this->loadEmailBody($order);
        $emailSubject = $this->subject;
        $emailCc = [];
        if ($this->for_customer) {
            $emailTo = $order->email;
        }
        else {
            $emailsString = $this->receivers;
            $data = explode(',', $emailsString);
            if (!empty($data)) {
                $emailTo = reset($data);
                array_shift($data);
                if (count($data) > 0)
                    $emailCc = $data;
            }
        }
        $mailer = Mailer::get($emailTo, $emailSubject, $emailBody, $emailTo);
        $mailer->setCc($emailCc);
        $mailer->send();

    }

    /**
     * @return bool
     */
    public function isOrderTemplate()
    {
        $isOrder = false;
        switch ($this->alias) {
            case self::ALIAS_NEW_ORDER:
            case self::ALIAS_PROCEEDING_ORDER:
            case self::ALIAS_COMPLETED_ORDER:
                $isOrder = true;
                break;
            default:
                break;
        }
        return $isOrder;
    }


}
