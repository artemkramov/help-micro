<?php

/**
 * @var \backend\models\Category $category
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \frontend\models\ProductFilter $searchModel
 * @var string $type
 * @var array $selectedSort
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => isset($type) ? $type : 'category'
], isset($category) ? $category : null);

?>
<script>
    var filterObject = '<?= $searchModel->getShortName() ?>';
</script>
<?php

$breadcrumbType = isset($type) ? $type : 'category';

echo \frontend\widgets\BreadcrumbWidget::widget([
    'model'      => $category,
    'type'       => $breadcrumbType,
    'commonName' => isset($title) ? $title : ''
]);

?>

<div class="center wow fadeInDown" style="visibility: hidden">
    <h1><?= isset($title) ? $title : $category->title ?></h1>
    <p class="lead">
        <? if ($dataProvider->totalCount > 0): ?>
        <span class="total-results-message"><?= \common\modules\i18n\Module::t('Count of products:') ?>
            <span class="total-number-of-products"><?= $dataProvider->totalCount ?></span>
        </span>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-th-list"></span>
            </a>
            <a href="#" id="grid" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-th"></span>
            </a>
        </div>
        <? endif; ?>
    </p>
</div>

<div class="row">
    <? if ($dataProvider->totalCount == 0): ?>
        <div class="col-sm-12">
            <p><?= \common\modules\i18n\Module::t('Nothing was found') ?></p>
        </div>
    <? else: ?>
        <div class="col-sm-12">
            <div class="products-container">
                <? if ($type == 'collection') {
                    $type .= '/' . $category->alias;
                } ?>
                <? echo $this->render('products', [
                    'dataProvider' => $dataProvider,
                    'type'         => $type
                ]); ?>
            </div>
        </div>
    <? endif; ?>
</div>

