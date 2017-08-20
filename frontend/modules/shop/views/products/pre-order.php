<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\modules\i18n\Module;

/**
 * @var array $sizes
 * @var \common\models\PreOrder $model
 */

?>
<div class="pre-order-wrapper hidden" id="template-pre-order">
    <? $form = ActiveForm::begin([
        'options' => [
            'id' => 'form-pre-order'
        ]
    ]); ?>

    <?= $form->field($model, 'full_name')->textInput([
        'class' => 'form-input'
    ]) ?>

    <?= $form->field($model, 'email')->textInput([
        'class' => 'form-input'
    ]) ?>

    <?= $form->field($model, 'size_id')->dropDownList($sizes, [
        'class' => 'form-input form-pre-order-size'
    ]) ?>

    <?= $form->field($model, 'product_id')->hiddenInput()->label('') ?>

    <div class="product-details-button-wrap pre-order">
        <?= $this->render('loading-spinner'); ?>
        <?= Html::submitButton(Module::t('Send'), [
            'class' => 'btn btn-black btn-uppercase btn-pre-order-send'
        ]) ?>
    </div>


    <? ActiveForm::end(); ?>
</div>