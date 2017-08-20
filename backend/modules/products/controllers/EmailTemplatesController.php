<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/30/2016
 * Time: 9:06 AM
 */

namespace backend\modules\products\controllers;


use backend\controllers\CRUDController;
use backend\models\EmailPreviewForm;
use common\models\EmailTemplate;
use common\models\Order;
use common\models\Search\EmailTemplateSearch;
use yii\web\ForbiddenHttpException;

/**
 * Class EmailTemplatesController
 * @package backend\modules\products\controllers
 */
class EmailTemplatesController extends CRUDController
{

    /**
     * Init bean class
     */
    public function init()
    {
        $this->beanClass = EmailTemplate::className();
        $this->beanSearchClass = EmailTemplateSearch::className();
        parent::init();
    }

    /**
     * @param int $id
     * @param bool $returnModel
     * @param array $extraParams
     * @return mixed
     */
    public function actionView($id, $returnModel = false, $extraParams = [])
    {
        $previewForm = new EmailPreviewForm();
        $previewForm->emailTemplateID = $id;
        $extraParams['previewForm'] = $previewForm;
        return parent::actionView($id, $returnModel, $extraParams);
    }

    /**
     * @param array $extraParams
     * @throws ForbiddenHttpException
     * @return null
     */
    public function actionCreate($extraParams = [])
    {
        throw new ForbiddenHttpException();
    }

    /**
     * @param $id
     * @param bool $returnModel
     * @throws ForbiddenHttpException
     * @return null
     */
    public function actionDelete($id, $returnModel = false)
    {
        throw new ForbiddenHttpException();
    }

    /**
     * Preview action
     */
    public function actionPreview()
    {
        $previewForm = new EmailPreviewForm();
        if ($previewForm->load(\Yii::$app->request->post()) && $previewForm->validate()) {
            $order = Order::findOne($previewForm->orderID);
            /**
             * @var EmailTemplate $emailTemplate
             */
            $emailTemplate = EmailTemplate::findOne($previewForm->emailTemplateID);
            $html = $emailTemplate->loadEmailBody($order);
            echo $html;
            exit;
        }
    }

}