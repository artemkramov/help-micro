<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'id'                     => 'product-form',
        'validationUrl'          => \yii\helpers\Url::to(['validate', 'id' => $model->id]),
        'options'                => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="row">
        <div class="col-sm-8">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'title',
                'parameters' => [

                ],
                'title'      => \common\modules\i18n\Module::t('Title')
            ]); ?>

            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'short_description',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Short description')
            ]); ?>

            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'content',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Text')
            ]); ?>


        </div>
        <div class="col-sm-4">
            <label><?= \common\modules\i18n\Module::t('Categories') ?></label>
            <?= \backend\widgets\CheckboxTree::widget([
                'tree'          => \backend\models\Category::getCategoryTree(),
                'fieldName'     => 'Product[category_ids]',
                'selectedItems' => $model->category_ids
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'editor_notes',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Editor notes')
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'enabled')->checkbox() ?>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'vendor_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <?php
    echo $form->field($model, 'images')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
        'title' => \common\modules\i18n\Module::t('Gallery'),
        'min'   => 0
    ])->label(false);
    ?>

    <?php
    echo $form->field($model, 'files')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
        'title' => \common\modules\i18n\Module::t('Files'),
        'min'   => 0
    ])->label(false);
    ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'currency_id')->dropDownList(\backend\models\Currency::listAll()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'buy_link')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->hiddenInput()->label('') ?>
        </div>
    </div>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
