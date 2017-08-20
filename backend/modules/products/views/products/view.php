<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\Product::getLabels(), [
    'type'        => 'view',
    'customTitle' => $model->getProductTitle()
]), $model);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'fileImage',
                'label'     => Module::t('Image'),
                'format'    => 'raw',
                'value'     => Html::img($model->getDefaultImage(), [
                    'class' => 'img-responsive product-thumb'
                ])
            ],
            [
                'attribute' => 'created_at',
                'format'    => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'datetime'
            ],
            'enabled',
            'vendor_code',
            'alias',
        ],
    ]) ?>

</div>
