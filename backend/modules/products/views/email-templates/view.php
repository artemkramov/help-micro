<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;
use backend\models\EmailPreviewForm;

/* @var $this yii\web\View */
/* @var $model \common\models\EmailTemplate
 * @var \backend\models\EmailPreviewForm $previewForm
 */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\EmailTemplate::getLabels(), [
    'type' => 'view',
]), $model);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>
    
    <? if  ($model->isOrderTemplate()): ?>
        <div class="email-preview">
            <? $form = \yii\bootstrap\ActiveForm::begin([
                'action' => 'preview'
            ]); ?>
            <h3><?= Module::t('Email preview') ?></h3>

            <?= $form->field($previewForm, 'emailTemplateID')->hiddenInput()->label(false) ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($previewForm, 'orderID')->dropDownList(EmailPreviewForm::getOrdersList())->label(Module::t('Order')) ?>
                </div>
                <div class="col-sm-6">
                    <?= Html::submitButton(Yii::t('yii', 'View'), [
                        'class' => 'btn btn-primary'
                    ]) ?>
                </div>
            </div>


            <? \yii\bootstrap\ActiveForm::end(); ?>

        </div>
    <? endif; ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            'alias',
            'enabled',
        ],
    ]) ?>

</div>
