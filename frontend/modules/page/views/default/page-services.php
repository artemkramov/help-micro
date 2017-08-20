<?php

/**
 * @var \common\models\Post $post
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['themePath']);

?>
<? echo \frontend\widgets\BreadcrumbWidget::widget([
    'model' => $post,
    'type'  => 'page'
]);?>
<div class="center wow fadeInDown" style="visibility: hidden">
    <h1><?= $post->title ?></h1>
    <p class="lead"></p>
</div>
