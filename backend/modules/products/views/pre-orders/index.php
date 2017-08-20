<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;
use common\models\PreOrder;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\PreOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$labels = \common\models\PreOrder::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type' => 'index'
]));
?>
<div class="pre-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'full_name',
            'email:email',
            [
                'attribute' => 'product_id',
                'label'     => Module::t('Product'),
                'format'    => 'raw',
                'value'     => function ($model) {
                    /**
                     * @var PreOrder $model
                     */
                    return Html::a($model->product->title, \yii\helpers\Url::to(['/products/products/view', 'id' => $model->product_id]));
                }
            ],
            [
                'attribute' => 'size_id',
                'label'     => Module::t('Size'),
                'value'     => function ($model) {
                    /**
                     * @var PreOrder $model
                     */
                    return $model->size->title;
                }
            ],

            [
                'class'    => 'yii\grid\ActionColumn',
                'template' => ''
            ],
        ],
    ]); ?>
</div>
