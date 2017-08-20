<?php

/**
 * @var \backend\models\Product[] $relatedProducts
 * @var string $blockName
 * @var string $suffix
 */
?>
<div class="<?= $blockName ?>-carousel-wrapper block-carousel-wrapper">
    <div class="swiper-prev-button-<?= $suffix ?> swiper-prev-button swiper-button icon-carousel_arrow-left"></div>
    <div class="swiper-container <?= $blockName ?>-image-carousel">
        <ul class="swiper-wrapper">
            <!-- Slides -->
            <? foreach ($relatedProducts as $counter => $relatedProduct): ?>
                <? if ($relatedProduct->id == $product->id) continue; ?>
                <li class="swiper-slide">
                    <a class="" href="<?= $relatedProduct->getUrl() ?>">
                        <div>
                            <img src="<?= $relatedProduct->getDefaultImage() ?>"
                                 class="product-image"/>
                        </div>
                        <div class="product-title">
                            <?= $relatedProduct->title ?>
                        </div>
                        <div class="product-price">
                            <?= $relatedProduct->getProductPriceFormatted() ?>
                        </div>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
    <div class="swiper-next-button-<?= $suffix ?> swiper-next-button swiper-button icon-carousel_arrow-right"></div>
</div>