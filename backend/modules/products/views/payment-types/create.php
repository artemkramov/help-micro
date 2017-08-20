<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;


/* @var $this yii\web\View */
/* @var $model common\models\PaymentType */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\PaymentType::getLabels(), [
    'type' => 'create'
]), $model);
?>
<div class="payment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
