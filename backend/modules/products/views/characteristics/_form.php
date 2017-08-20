<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Characteristic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristic-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= \common\widgets\MultiLanguageInput::widget([
        'form'       => $form,
        'model'      => $model,
        'field'      => 'title',
        'parameters' => [

        ],
        'title'      => \common\modules\i18n\Module::t('Title')
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'characteristic_group_id')->dropDownList(\backend\models\Characteristic::getGroupDropdown()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'sort')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'alias')->textInput() ?>
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

    <div class="row">
        <div class="col-sm-6">
            <?= \common\widgets\MultiLanguageInput::widget([
                'form'       => $form,
                'model'      => $model,
                'field'      => 'description',
                'parameters' => [
                    'textarea' => [
                        'data-group' => 'common'
                    ]
                ],
                'title'      => \common\modules\i18n\Module::t('Text')
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?= \backend\widgets\FileField::widget([
                'form'          => $form,
                'model'         => $model,
                'fileAttribute' => 'fileCampaign',
                'attribute'     => 'campaign',
            ]) ?>
        </div>
    </div>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
