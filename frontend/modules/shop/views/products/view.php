<?php

use common\components\Number;
use backend\models\Currency;
use common\modules\i18n\Module;
use yii\helpers\Html;

/**
 * @var \backend\models\Product $product
 * @var \common\models\Setting $settings
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'product'
], $product);
$galleryData = $product->getGalleryData();

?>
<div id="content">

    <div class="breadcrumbs-product">
        <?
        echo \frontend\widgets\BreadcrumbWidget::widget([
            'type'  => 'product',
            'model' => $product
        ]);
        ?>
    </div>
    <div class="center wow fadeInDown animated" style="visibility: hidden;">
        <h1><?= $product->title ?></h1>
        <p class="lead"></p>
    </div>
    <div class="product-card clearfix" itemscope="" itemtype="http://schema.org/Product">
        <?= Html::tag('meta', '', [
            'itemprop' => 'category',
            'content'  => $product->getCategoriesList(),
        ]) ?>
        <!-- PRODUCT CARD START -->
        <div class="container-title">
            <?
            echo \yii\helpers\Html::tag('meta', '', [
                'itemprop' => 'name',
                'content'  => $product->title
            ]);
            echo \yii\helpers\Html::tag('meta', '', [
                'itemprop' => 'url',
                'property' => 'og:url',
                'content'  => rtrim(\yii\helpers\Url::home(true), '/') . $product->getUrl()
            ]);
            echo \yii\helpers\Html::tag('meta', '', [
                'itemprop' => 'productID',
                'content'  => $product->id
            ]);
            ?>
            <h2 class="product-short-description"><?= $product->short_description ?></h2>
            <div class="product-buy-block <?= empty($product->short_description) ? 'empty-description' : '' ?>">
                <a href="<?= $product->buy_link ?>" class="btn btn-success btn-lg" target="_blank">
                    <i class="fa fa-shopping-cart"></i> <?= Module::t('Buy') ?>
                </a>
            </div>
        </div>
        <!-- GALLERY START -->
        <div class="container-imagery">
            <?= \yii\helpers\Html::tag('meta', '', [
                'itemprop' => 'image',
                'content'  => \Yii::$app->request->hostInfo . $product->getDefaultImage(),
            ]); ?>
            <? if (count($galleryData['thumbnails']) > 0): ?>
                <div class="thumbnail-wrapper pull-left">
                    <div class="thumbnail-prev-button swiper-button">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </div>
                    <div class="swiper-container thumbnail-carousel swiper-container-vertical"
                         style="height: <?= count($galleryData['thumbnails']) * 70 ?>px">
                        <ul class="swiper-wrapper thumbnails">
                            <? foreach ($galleryData['thumbnails'] as $thumbnail): ?>
                                <li class="swiper-slide">
                                    <img src="<?= $thumbnail ?>" class="thumbnail-image"/>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                    <div class="thumbnail-next-button swiper-button">
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </div>
                </div>
            <? endif; ?>
            <div class="main-carousel-wrapper">
                <div class="swiper-container main-image-carousel">
                    <!-- Additional required wrapper -->
                    <div
                        class="swiper-prev-button swiper-prev-button-main slider-prev-button swiper-button fa fa-chevron-left"></div>
                    <ul class="swiper-wrapper">
                        <!-- Slides -->
                        <? foreach ($galleryData['main'] as $counter => $image): ?>
                            <li class="swiper-slide">
                                <div>
                                    <img src="<?= $image ?>" class="product-image zoom"
                                         data-zoom-image="<?= $galleryData['large'][$counter] ?>"/>
                                </div>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <div class="swiper-next-button swiper-next-button-main swiper-button fa fa-chevron-right"></div>
                </div>
                <div class="product-zoom">
                    <button class="btn btn-primary btn-product-image-zoom"><i
                            class="fa fa-search-plus"></i> <?= Module::t('Zoom') ?></button>
                </div>
            </div>

        </div>
        <!-- GALLERY END -->

        <div class="container-details">


        </div>
    </div>
    <!-- PRODUCT CARD END -->

    <!-- DETAILS -->
    <div class="product-card-details">
        <ul class="nav nav-tabs">
            <? if (!empty($product->editor_notes)): ?>
            <li class="active"><a data-toggle="tab" href="#description"
                                  class="scroll"><?= Module::t('Description') ?></a></li>
            <? endif; ?>
            <li class="<?= empty($product->editor_notes) ? 'active' : '' ?>"><a data-toggle="tab" href="#features" class="scroll"><?= Module::t('Characteristics') ?></a></li>
            <? if (!empty($product->files)): ?>
                <li><a data-toggle="tab" href="#useful-data" class="scroll"><?= Module::t('Useful files') ?></a></li>
            <? endif; ?>
        </ul>

        <div class="tab-content">
            <? if (!empty($product->editor_notes)): ?>
            <div id="description" class="tab-pane fade in active">
                <?= $product->editor_notes ?>
            </div>
            <? endif; ?>
            <div id="features" class="tab-pane fade <?= empty($product->editor_notes) ? 'in active' : '' ?>">
                <?= $product->content ?>
            </div>
            <? if (!empty($product->files)): ?>
                <div id="useful-data" class="tab-pane fade">
                    <? foreach ($product->files as $file): ?>
                    <p>
                        <?= Module::t($file->name) ?> (<a href="<?= $file->file ?>" target="_blank"><?= Module::t('Download') ?></a>)
                    </p>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
        </div>
    </div>
    <!-- END DETAILS -->

</div>
