<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\Product::getLabels(), [
    'type'        => 'update',
    'customTitle' => $model->getProductTitle()
]), $model);
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
