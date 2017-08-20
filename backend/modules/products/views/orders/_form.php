<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Order;
use common\models\PaymentType;
use common\modules\i18n\Module;
use common\models\Lang;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */

/**
 * @var Lang $currentLang
 */
$currentLang = Lang::getCurrent();

?>

<div class="order-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation'   => true,
        'enableClientValidation' => false,
        'id'                     => 'order-form',
        'validationUrl'          => \yii\helpers\Url::to(['validate', 'id' => $model->id]),
        'options'                => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(Order::getStatuses()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= \backend\widgets\related_bean\RelatedBean::widget([
                'label'           => Module::t('User'),
                'controllerPopup' => '/users/users/popup',
                'controllerView'  => '/users/users/view',
                'inputName'       => 'Order[user_id]',
                'labelField'      => 'username',
                'relatedBean'     => $model->user,
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'payment_type_id')->dropDownList(PaymentType::listAllLocalized()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <?
    echo $form->field($model, 'address')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
        'title'           => Module::t('Address book'),
        'min'             => 1,
        'enableAddOption' => false
    ])->label(false);
    ?>

    <?
    echo $form->field($model, 'orderItems')->widget(\backend\widgets\multiple_bean\MultipleBean::className(), [
        'title'           => Module::t('Positions'),
        'min'             => 1,
    ])->label(false);
    ?>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
