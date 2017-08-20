<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\BreadcrumbHelper;
use common\modules\i18n\Module;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$labels = \backend\models\Product::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type' => 'index'
]));
?>
<div class="product-index">

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
                'attribute' => 'title',
                'label'     => \common\modules\i18n\Module::t('Title')
            ],
            [
                'attribute' => 'fileImage',
                'label'     => Module::t('Image'),
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
            'vendor_code',
            [
                'attribute' => 'category_ids',
                'value' => function ($model) {
                    /**
                     * @var \backend\models\Product $model
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


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
