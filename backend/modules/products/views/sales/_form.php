<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\i18n\Module;
use backend\models\Characteristic;

/* @var $this yii\web\View */
/* @var $model common\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'id'                     => 'sale-form',
        'validationUrl'          => \yii\helpers\Url::to(['validate', 'id' => $model->id]),
        'options'                => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'percentage')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'enabled')->checkbox() ?>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label><?= Module::t('Load products from the collection:') ?></label>
                <?= Html::dropDownList('', null, ['' => ''] + Characteristic::getDropdownList('collection'), [
                    'class' => 'form-control select-collection',
                ]) ?>
            </div>
        </div>
    </div>

    <div class="sale-products-block">
        <?
        echo $form->field($model, 'saleProducts')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
            'title' => Module::t('Products'),
            'min'   => 0,
        ])->label(false);
        ?>
    </div>


    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
