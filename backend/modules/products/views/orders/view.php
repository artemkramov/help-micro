<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$labels = \common\models\Order::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type'        => 'view',
    'customTitle' => \common\modules\i18n\Module::t($labels['singular']) . ' #' . $model->id
]), $model);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'email:email',
            [
                'attribute' => 'totalPrice',
                'label'     => Module::t('In total'),
                'value'     => $model->getTotalPrice(true),
            ],
            [
                'attribute' => 'status',
                'value'     => $model->getStatus(),
            ],
            [
                'attribute' => 'payment_type_id',
                'value'     => $model->paymentType->title,
            ],
        ],
    ]) ?>

    <h3><?= \common\modules\i18n\Module::t('Positions') ?></h3>
    <table class="table table-striped table-order-view">
        <thead>
        <tr>
            <th>#</th>
            <th><?= Module::t('Product') ?></th>
            <th><?= Module::t('Image') ?></th>
            <th><?= Module::t('Count') ?></th>
            <th><?= Module::t('Price') ?></th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($model->orderItems as $key => $item): ?>
            <?
            /**
             * @var \common\models\OrderItem $item
             */
            ?>
            <tr>
                <td><?= ++$key ?></td>
                <td>
                    <?= Html::a($item->product->title, \yii\helpers\Url::to(['/products/products/view', 'id' => $item->product_id]), [
                        'target' => '_blank',
                    ]) ?>
                </td>
                <td>
                    <?= Html::img($item->product->getDefaultImage([
                        'class' => 'img-responsive',
                    ]))?>
                </td>
                <td>
                    <?= $item->count ?>
                </td>
                <td>
                    <?= $item->getFormattedPrice() ?>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>


</div>
