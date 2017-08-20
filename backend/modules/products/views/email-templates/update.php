<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model \common\models\EmailTemplate */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\EmailTemplate::getLabels(), [
    'type'        => 'update',
]), $model);
?>
<div class="post-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
