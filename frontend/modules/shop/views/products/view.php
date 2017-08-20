<?php

use common\components\Number;
use backend\models\Currency;
use common\modules\i18n\Module;
use yii\helpers\Html;

/**
 * @var \backend\models\Product $product
 * @var \frontend\models\ProductForm $productForm
 * @var array $sizes
 * @var \common\models\Setting $settings
 * @var \frontend\models\PreOrderForm $preOrderForm
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
    <div class="product-card vc_row wpb_row vc_row-fluid" itemscope="" itemtype="http://schema.org/Product">
        <?= Html::tag('meta', '', [
            'itemprop' => 'category',
            'content'  => $product->getCategoriesList(),
        ]) ?>
        <!-- PRODUCT CARD START -->
        <div class="container-title">
            <h1 class="product-title"><?= $product->getProductBrandDefault()->title ?></h1>
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

            <!-- VENDOR CODE -->
            <div class="top-product-code">
                <div class="product-code">
                    <?= Module::t('Vendor code') ?>:
                    <span><?= $product->vendor_code ?></span>
                </div>
            </div>
            <!-- VENDOR CODE END -->

            <div class="product-price-wrapper">
                <? if ($product->getActionDiscount() > 0): ?>
                    <span class="amount old">
                        <?= $product->getProductPriceFormatted(null, true); ?>
                    </span>
                <? endif; ?>
                <?
                $formattedPrice = number_format($product->getProductPrice(), 0, Number::DECIMAL_SEPARATOR, Number::THOUSAND_SEPARATOR);
                $currentCurrency = Currency::getCurrentCurrency();
                echo $this->render('_price', [
                    'formattedPrice'  => $formattedPrice,
                    'currentCurrency' => $currentCurrency,
                    'price'           => $product->getProductPrice(),
                ])
                ?>
            </div>
            <?
            $relatedColorProducts = $product->getRelatedIcons();
            if (count($relatedColorProducts) > 1):
                ?>
                <div class="product-related-colors">
                    <? foreach ($relatedColorProducts as $data): ?>
                        <a href="<?= $data['link'] ?>">
                            <img src="<?= $data['icon'] ?>"/>
                        </a>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
        </div>
        <!-- GALLERY START -->
        <div class="container-imagery">
            <?= \yii\helpers\Html::tag('meta', '', [
                'itemprop' => 'image',
                'content'  => \Yii::$app->request->hostInfo . $product->getDefaultImage(),
            ]); ?>
            <? if (count($galleryData['thumbnails']) > 0): ?>
                <div class="thumbnail-wrapper">
                    <div class="thumbnail-prev-button swiper-button">
                        <span class="icon-arrow_up"></span>
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
                        <span class="icon-arrow_down"></span>
                    </div>
                    <? if (!empty($product->video)): ?>
                        <div class="icon icon-video_play js-play-video">Play</div>
                    <? endif; ?>
                </div>
            <? endif; ?>
            <div class="main-carousel-wrapper">
                <div class="swiper-container main-image-carousel">
                    <!-- Additional required wrapper -->
                    <div
                        class="swiper-prev-button swiper-prev-button-main slider-prev-button swiper-button icon-carousel_arrow-left"></div>
                    <ul class="swiper-wrapper">
                        <!-- Slides -->
                        <? foreach ($galleryData['main'] as $counter => $image): ?>
                            <li class="swiper-slide">
                                <div>
                                    <img src="<?= $image ?>" class="product-image zoom"
                                         data-zoom-img="<?= $galleryData['large'][$counter] ?>"/>
                                </div>
                            </li>
                        <? endforeach; ?>
                    </ul>
                    <div
                        class="swiper-next-button swiper-next-button-main swiper-button icon-carousel_arrow-right"></div>
                </div>
            </div>
            <? if (!empty($product->video)): ?>
                <div>
                    <div id="video-container" class="style-scope nap-video">
                        <video controls muted preload="auto" class="video-js vjs-default-skin vjs-big-play-centered"
                               data-setup='{"example_option":true}'>
                            <source
                                src="<?= \Yii::$app->request->hostInfo . \yii\helpers\Url::to($product->video) ?>"
                                type="video/mp4"/>
                        </video>
                        <button id="close" type="button" class="btn-video-close close style-scope">
                            <div class="icon-cross_black style-scope" aria-label="Close"></div>
                        </button>
                    </div>
                </div>
            <? endif; ?>
        </div>
        <!-- GALLERY END -->
        <!-- VIDEO FOR MOBILE DEVICES -->
        <div class="product-video-mobile">
            <div>
                <? if (!empty($product->video)): ?>
                    <button class="btn btn-white btn-video-mobile vid-opener">
                        <?= Module::t('Video') ?>
                        <span class="icon-direction icon-arrow_down"></span>
                    </button>
                    <div class="video-tag">
                        <video controls muted preload="auto" class="video-js vjs-default-skin vjs-big-play-centered"
                               data-setup='{"example_option":true}'>
                            <source
                                src="<?= \Yii::$app->request->hostInfo . \yii\helpers\Url::to($product->video) ?>"
                                type="video/mp4"/>
                        </video>
                    </div>
                <? endif; ?>
            </div>
        </div>
        <!-- VIDEO FOR MOBILE DEVICES END -->
        <div class="container-details">
            <div>
                <? $form = \yii\widgets\ActiveForm::begin([
                    'id'                     => 'product-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validationUrl'          => \yii\helpers\Url::to(['validate']),
                    'validateOnBlur'         => false,
                ]); ?>
                <? echo $form->field($productForm, 'product')->hiddenInput()->label(false); ?>
                <div class="vc_row wpb_row vc_row-fluid product-details-inner">
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <?= $form->field($productForm, 'size')->dropDownList($sizes, [
                            'class' => 'form-select-size form-input'
                        ])->label(false) ?>
                    </div>
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <?= $form->field($productForm, 'count')->textInput([
                            'class'       => 'form-input form-input-number',
                            'placeholder' => Module::t('Count'),
                        ])->label(false) ?>
                    </div>
                </div>
                <div class="vc_row wpb_row vc_row-fluid product-details-add-to-basket">
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <div class="product-details-button-wrap">
                            <? if ($product->isInStock()): ?>
                                <?= $this->render('loading-spinner'); ?>
                                <?= \yii\helpers\Html::submitButton(Module::t('Add to shopping bag'), [
                                    'class' => 'btn btn-black btn-uppercase btn-add-to-basket',
                                    'name'  => 'add-to-basket'
                                ]) ?>
                            <? else: ?>
                                <?= Html::button(Module::t('Pre-order'), [
                                    'class' => 'btn btn-black btn-uppercase btn-pre-order'
                                ]) ?>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
                <? if (!Yii::$app->user->isGuest): ?>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="product-details-button-wrap wishlist">
                                <?= $this->render('loading-spinner'); ?>
                                <button type="button" class="btn-uppercase btn-add-to-wishlist"
                                        name="btnWishList" data-product="<?= $product->id ?>">
                                    <span class="default-text">
                                        <img src="/uploads/favourite.png"/> <?= Module::t('Add to wish list') ?>
                                    </span>
                                    <span class="added-text"><?= Module::t('Successfully added') ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                <? endif; ?>
            </div>

            <!-- ACCORDION START -->
            <div class="vc_row wpb_row vc_row-fluid">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div id="product-details-accordion" class="product-details">
                        <div class="size-and-fit js-accordion-tab accordion-tab active">
                            <div class="icon style-scope widget-show-hide icon-minus"></div>
                            <div class="show-hide-title heading">
                                <?= Module::t('Size & fit information') ?>
                            </div>
                            <div class="show-hide-content" style="display: block">
                                <div class="wrapper">
                                    <?= $product->size_fit ?>
                                    <a href="<?= \frontend\components\FrontendHelper::formLink('/product/view-size/' . $product->id) ?>"
                                       target="_blank" class="view-measurements">
                                        <?= Module::t('Table size') ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="editor-notes js-accordion-tab accordion-tab">
                            <div class="icon style-scope widget-show-hide icon-plus"></div>
                            <div class="show-hide-title heading">
                                <?= Module::t('Editor notes') ?>
                            </div>
                            <div class="show-hide-content">
                                <div class="wrapper">
                                    <?= $product->editor_notes ?>
                                    <?= $product->content ?>
                                </div>
                            </div>
                        </div>

                        <div class="delivery-notes js-accordion-tab accordion-tab">
                            <div class="icon style-scope widget-show-hide icon-plus"></div>
                            <div class="show-hide-title heading">
                                <?= Module::t('Delivery') ?>
                            </div>
                            <div class="show-hide-content">
                                <div class="wrapper">
                                    <?= $settings->product_delivery_description ?>
                                </div>
                                <div class="delivery-more">
                                    <a href="<?= \frontend\components\FrontendHelper::formLink('/delivery') ?>"><?= Module::t('More') ?></a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ACCORDION END -->

            <? \yii\widgets\ActiveForm::end(); ?>

            <!-- PRE-ORDER TEMPLATE -->
            <?= $this->render('pre-order', [
                'sizes' => $sizes,
                'model' => $preOrderForm
            ]); ?>

        </div>
    </div>
    <!-- PRODUCT CARD END -->
</div>
<!-- HOW TO WEAR IT START -->
<? $kits = $product->getKits(); ?>
<? if (count($kits) > 0): ?>
    <div class="product-how-to-wear-it product-block">
        <div class="product-card-title">
            <?= Module::t('How to wear it') ?>
        </div>
        <? if (count($kits) > 1): ?>
            <div class="how-to-wear-topic">
                <ul class="tabs product-kit-tabs swiper-wrapper">
                    <? foreach ($kits as $kit): ?>
                        <li class="swiper-slide">
                            <a href="#kit<?= $kit->id ?>">
                                <img src="<?= $kit->image ?>" class="product-kit-image"/>
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        <? endif; ?>
        <? foreach ($kits as $kit): ?>
            <div id="kit<?= $kit->id ?>">
                <?= $this->render('_block', [
                    'relatedProducts' => $kit->products,
                    'suffix'          => 'wear',
                    'blockName'       => 'how-to-wear',
                    'product'         => $product,
                ]) ?>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>
<!-- HOW TO WEAR END -->

<!-- YOU MAY ALSO LIKE START -->
<? $relatedProducts = $product->getRelatedProducts(); ?>
<? if (!empty($relatedProducts)): ?>
    <div class="product-you-may-also-like-it product-block">
        <div class="product-card-title">
            <?= Module::t('You may also like it') ?>
        </div>
        <?= $this->render('_block', [
            'relatedProducts' => $relatedProducts,
            'suffix'          => 'like',
            'blockName'       => 'you-may-also-like',
            'product'         => $product,
        ]) ?>
    </div>
<? endif; ?>
</div>
<!-- YOU MAY ALSO LIKE END -->
</div>
