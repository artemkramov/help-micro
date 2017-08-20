<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmailSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_from')->textInput(['maxlength' => true]) ?>

    <?= \common\widgets\MultiLanguageInput::widget([
        'form'       => $form,
        'model'      => $model,
        'field'      => 'footer',
        'parameters' => [
            'textarea' => [
                'data-group' => 'common'
            ]
        ],
        'title'      => \common\modules\i18n\Module::t('Footer')
    ]); ?>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
