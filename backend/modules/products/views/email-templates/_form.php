<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\models\EmailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= \common\widgets\MultiLanguageInput::widget([
        'form'       => $form,
        'model'      => $model,
        'field'      => 'subject',
        'parameters' => [

        ],
        'title'      => \common\modules\i18n\Module::t('Email subject')
    ]); ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <? if (!$model->for_customer): ?>
    <?= $form->field($model, 'receivers')->textInput() ?>
    <? endif; ?>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
