<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Template */
/* @var $form yii\widgets\ActiveForm */
?>
<input type="hidden" id="json-templates" value="<?= htmlspecialchars(json_encode($templates))?>" />
<div class="template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6, 'class' => 'form-control textarea-common', 'data-group' => $model->alias]) ?>

    <?= $form->field($model, 'footer')->textarea(['rows' => 6, 'class' => 'form-control textarea-common', 'data-group' => 'common']) ?>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
