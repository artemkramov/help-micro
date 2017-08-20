<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Category */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\Category::getLabels(), [
    'type' => 'create'
]), $model);
?>
<div class="category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
