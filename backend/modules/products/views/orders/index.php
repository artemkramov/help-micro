<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;
use common\models\Order;

/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$labels = \common\models\Order::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type' => 'index'
]));
?>
<div class="order-index">

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
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label'     => Module::t('Number'),
                'value'     => function ($model) {
                    return '#' . $model->id;
                }
            ],
            'email:email',
            [
                'attribute' => 'totalPrice',
                'label'     => Module::t('In total'),
                'value'     => function ($model) {
                    /**
                     * @var Order $model
                     */
                    return $model->getTotalPrice(true);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /**
                     * @var Order $model
                     */
                    return $model->getStatus();
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', ['' => ''] + Order::getStatuses(),
                    [
                        'class' => 'form-control'
                    ])
            ],
            [
                'attribute' => 'payment_type_id',
                'value' => function ($model) {
                    /**
                     * @var Order $model
                     */
                    return $model->paymentType->title;
                },
                'filter' => Html::activeDropDownList($searchModel, 'payment_type_id', ['' => ''] + \common\models\PaymentType::listAllLocalized(),
                    [
                        'class' => 'form-control'
                    ])
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
