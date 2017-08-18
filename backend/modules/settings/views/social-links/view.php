<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\SocialLink */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\SocialLink::getLabels(), [
    'type' => 'view'
]), $model);
?>
<div class="social-link-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'url',
                'value'     => Html::a($model->url, $model->url, ['target' => '_blank']),
                'format'    => 'raw'
            ],
            'alias',
            'sort',
        ],
    ]) ?>

</div>
