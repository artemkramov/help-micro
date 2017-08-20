<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Delivery */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\common\models\Delivery::getLabels(), [
    'type'        => 'view',
    'customTitle' => $model->title
]), $model);
?>
<div class="delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'enabled',
            'alias',
            [
                'attribute' => 'price',
                'value'     => $model->getPriceFormatted()
            ]
        ],
    ]) ?>

</div>
