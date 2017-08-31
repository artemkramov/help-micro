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
    <p class="lead"><?= \common\modules\i18n\Module::t('About us lead text') ?></p>
</div>
<!-- about us slider -->
<div id="about-slider">
    <div id="carousel-slider" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators visible-xs">
            <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-slider" data-slide-to="1"></li>
            <li data-target="#carousel-slider" data-slide-to="2"></li>
            <li data-target="#carousel-slider" data-slide-to="3"></li>
            <li data-target="#carousel-slider" data-slide-to="4"></li>
            <li data-target="#carousel-slider" data-slide-to="5"></li>
            <li data-target="#carousel-slider" data-slide-to="6"></li>
            <li data-target="#carousel-slider" data-slide-to="7"></li>
            <li data-target="#carousel-slider" data-slide-to="8"></li>
        </ol>

        <div class="carousel-inner">
            <div class="item active">
                <img src="<?= $directoryAsset ?>/images/about-us/slider1.jpeg" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider2.png" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider3.jpeg" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider4.png" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider5.jpeg" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider6.jpg" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider7.jpg" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?= $directoryAsset ?>/images/about-us/slider8.jpg" class="img-responsive" alt="">
            </div>
        </div>

        <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>

        <a class=" right carousel-control hidden-xs" href="#carousel-slider" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div> <!--/#carousel-slider-->
</div><!--/#about-slider-->

<!-- Our Skill -->
<div class="skill-wrap clearfix">

    <div class="center wow fadeInDown">
        <h2><?= \common\modules\i18n\Module::t('Our achievements') ?></h2>
        <p class="lead"><?= $post->content ?></p>
    </div>
