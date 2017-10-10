<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Novelty */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\Novelty::getLabels(), [
    'type'        => 'update',
    'customTitle' => $model->getPostTitle()
]), $model);
?>
<div class="novelty-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
