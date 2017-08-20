<?php

/**
 * @var \backend\models\Category[] $categories
 */

$post = new stdClass();
$post->title = \common\modules\i18n\Module::t('Shop');
\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

?>
<? echo \frontend\widgets\BreadcrumbWidget::widget([
    'model' => $post,
    'type'  => 'page'
]);?>
<div class="center wow fadeInDown" style="visibility: hidden">
    <h1><?= $post->title ?></h1>
    <p class="lead"></p>
</div>

<div class="category-wrapper clear">
    <? foreach ($categories as $category): ?>
    <a href="<?= $category->getViewLink() ?>" class="vc_col-sm-<?= $width ?>">
        <div class="category-item-img-wrap" style="background-image: url(<?= $category->image ?>)">
            <div class="category-title-wrap">
                <h2 class="category-title"><?= $category->title ?></h2>
            </div>
        </div>
    </a>
    <? endforeach; ?>
</div>
