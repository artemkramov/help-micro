<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductRelation */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\ProductRelation::getLabels(), [
    'type'        => 'view',
    'customTitle' => $model->product->title . ':' . $model->productRelated->title
]), $model);

$imageProduct = Html::img($model->product->getDefaultImage(), [
    'class' => 'img-responsive product-thumb'
]);
$imageProductRelated = Html::img($model->productRelated->getDefaultImage(), [
    'class' => 'img-responsive product-thumb'
]);

?>
<div class="product-relation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'product_id',
                'value' => Html::a($imageProduct, \yii\helpers\Url::to(['/products/products/view', 'id' => $model->product_id]), [
                    'target' => '_blank',
                ]),
                'format' => 'raw'
            ],
            [
                'attribute' => 'product_related_id',
                'value' => Html::a($imageProductRelated, \yii\helpers\Url::to(['/products/products/view', 'id' => $model->product_related_id]), [
                    'target' => '_blank',
                ]),
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>
