<?php

/**
 * @var \common\models\Post $post
 * @var \backend\models\Category[] $categories
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['themePath']);
$blocks = array_chunk($categories, 4);

?>
<? echo \frontend\widgets\BreadcrumbWidget::widget([
    'model' => $post,
    'type'  => 'page'
]); ?>
<div class="center wow fadeInDown" style="visibility: hidden">
    <h1><?= $post->title ?></h1>
    <p class="lead"></p>
</div>
<div class="categories-block">
    <? foreach ($blocks as $categoryRow): ?>
        <div class="row">
            <?
            /**
             * @var \backend\models\Category $category
             */
            ?>
            <? foreach ($categoryRow as $category): ?>
                <div class="col-sm-4 category-item">
                    <div class="">
                        <a href="<?= $category->getUrl() ?>">
                            <img class="img-responsive" src="<?= $category->image ?>"/>
                        </a>
                    </div>
                    <a class="btn btn-danger" href="<?= $category->getUrl() ?>"><?= $category->title ?></a>
                </div>
            <? endforeach; ?>
        </div>
    <? endforeach; ?>
</div>