<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Customer */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\Customer::getLabels(), [
    'type' => 'create'
]), $model);
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
