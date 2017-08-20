<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductRelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$labels = \backend\models\ProductRelation::getLabels();
\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type' => 'index'
]));
?>
<div class="product-relation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= \backend\widgets\FormButtons::widget([
            'model'      => false,
            'type'       => 'create',
            'modelLabel' => $labels['singular']
        ]); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'productImage',
                'label'     => \common\modules\i18n\Module::t('Product'),
                'value'     => function($model) {
                    /**
                     * @var \backend\models\ProductRelation $model
                     */
                    $image = Html::img($model->product->getDefaultImage(), [
                        'class' => 'img-responsive product-thumb'
                    ]);
                    return Html::a($image, \yii\helpers\Url::to(['/products/products/view', 'id' => $model->product_id]), [
                        'target' => '_blank',
                    ]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'productAlias',
                'label'     => \common\modules\i18n\Module::t('Alias'),
                'value'     => function($model) {
                    /**
                     * @var \backend\models\ProductRelation $model
                     */
                    return $model->product->alias;
                }
            ],
            [
                'attribute' => '$productRelatedImage',
                'label'     => \common\modules\i18n\Module::t('Product related'),
                'value'     => function($model) {
                    /**
                     * @var \backend\models\ProductRelation $model
                     */
                    $image = Html::img($model->productRelated->getDefaultImage(), [
                        'class' => 'img-responsive product-thumb'
                    ]);
                    return Html::a($image, \yii\helpers\Url::to(['/products/products/view', 'id' => $model->product_related_id]), [
                        'target' => '_blank',
                    ]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'productRelatedAlias',
                'label'     => \common\modules\i18n\Module::t('Alias'),
                'value'     => function($model) {
                    /**
                     * @var \backend\models\ProductRelation $model
                     */
                    return $model->productRelated->alias;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
