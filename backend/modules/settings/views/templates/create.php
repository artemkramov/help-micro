<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\Template */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\Template::getLabels(), [
    'type' => 'create'
]), $model);
?>
<div class="template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'templates' => $templates
    ]) ?>

</div>
