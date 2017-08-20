<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var string $openerID
 * @var string $labelField
 */


$labels = \backend\models\Product::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type' => 'index'
]));
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'fileImage',
                'label'     => \common\modules\i18n\Module::t('Image'),
                'format'    => 'raw',
                'value'     => function ($model) {
                    /**
                     * @var \backend\models\Product $model
                     */
                    return Html::img($model->getDefaultImage(), [
                        'class' => 'img-responsive product-thumb'
                    ]);
                }
            ],
            [
                'attribute' => 'title',
                'label'     => \common\modules\i18n\Module::t('Title'),
                'format'    => 'raw',
                'value'     => function ($model) use ($openerID, $labelField) {
                    /**
                     * @var \backend\models\Product $model
                     */
                    return Html::a($model->title, '#', [
                        'class'       => 'btn-to-relation-input',
                        'data-id'     => $model->id,
                        'data-label'  => $model->{$labelField},
                        'data-url'    => \yii\helpers\Url::to(['view', 'id' => $model->id]),
                        'data-opener' => $openerID,
                        'data-image'  => $model->getDefaultImage()
                    ]);
                },
            ],
            'vendor_code',
            [
                'attribute' => 'category_ids',
                'value' => function ($model) {
                    /**
                     * @var $model \backend\models\Product
                     */
                    return $model->getCategoriesList();
                },
                'filter' => Html::activeDropDownList($searchModel, 'category_ids', \backend\models\Category::getCategoryDropdown(null),
                    [
                        'class' => 'form-control'
                    ])
            ],
            [
                'attribute' => 'enabled',
                'value' => function ($model) {
                    return \backend\components\SiteHelper::getCheckboxSign($model->enabled);
                },
                'filter' => Html::activeDropDownList($searchModel, 'enabled', \backend\components\SiteHelper::getCheckboxDropdown(),
                    [
                        'class' => 'form-control'
                    ])
            ],
        ],
    ]); ?>
</div>
