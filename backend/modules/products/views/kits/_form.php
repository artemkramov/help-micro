<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Kit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kit-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'id'                     => 'kit-form',
        'validationUrl'          => \yii\helpers\Url::to(['validate', 'id' => $model->id]),
        'options'                => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= \backend\widgets\ImageField::widget([
                'form'          => $form,
                'model'         => $model,
                'fileAttribute' => 'fileImage',
                'attribute'     => 'image',
            ]) ?>
        </div>
    </div>
    <input type="hidden" name="Kit[product_ids]" value="" id="">
    <?php
    echo $form->field($model, 'items')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
        'title' => \common\modules\i18n\Module::t('Products'),
        'min'   => 1
    ])->label(false);
    ?>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
