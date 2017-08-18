<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'table_size',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Table size')
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'seo_category_description',
                'parameters' => [
                    'textinput' => [
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Seo category description')
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'product_delivery_description',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Product delivery description')
            ]); ?>
        </div>
    </div>


    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
