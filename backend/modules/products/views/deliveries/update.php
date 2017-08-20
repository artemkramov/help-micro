<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Delivery */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\Delivery::getLabels(), [
    'type'        => 'update',
    'customTitle' => $model->title
]), $model);
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
