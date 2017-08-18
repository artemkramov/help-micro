<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\SocialLink */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\SocialLink::getLabels(), [
    'type' => 'update'
]), $model);
?>
<div class="social-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
