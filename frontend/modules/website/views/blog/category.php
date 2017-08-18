<?php

use common\modules\i18n\Module;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \frontend\models\BlogPostFilter $searchModel
 * @var \common\models\BlogCategory $blogCategory
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'blogCategory',
], $blogCategory);

echo \frontend\widgets\BreadcrumbWidget::widget([
    'type'       => 'common',
    'commonName' => $blogCategory->title
]);

?>

<div class="vc_row wpb_row vc_row-fluid">
    <? if ($dataProvider->totalCount == 0): ?>
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <p><?= \common\modules\i18n\Module::t('Nothing was found') ?></p>
        </div>
    <? else: ?>
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="blog-posts-container">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options'      => [
                        'tag'   => 'div',
                        'class' => 'blog-post-list',
                    ],
                    'itemView'     => '_list',
                    'summary'      => '',
                    'itemOptions'  => [
                        'tag' => false,
                    ],
                ]); ?>
            </div>
        </div>
    <? endif; ?>


    <!-- PAGINATION -->
    <div class="woocommerce">
        <nav class="woocommerce-pagination">
            <?= \yii\widgets\LinkPager::widget([
                'pagination'     => $dataProvider->pagination,
                'maxButtonCount' => 6,
                'options'        => [
                    'class' => 'page-numbers'
                ],
                'prevPageLabel'  => '←',
                'nextPageLabel'  => '→'
            ]) ?>
        </nav>
    </div>

</div>
