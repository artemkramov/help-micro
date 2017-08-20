<?php

/**
 * @var \backend\models\Currency $currentCurrency
 * @var string $formattedPrice
 * @var string $price
 */

$currencySpan = \yii\helpers\Html::tag('span', $currentCurrency->sign, [
    'class'    => 'currency',
]);

$hiddenCurrencySpan = \yii\helpers\Html::tag('span', '', [
    'itemprop' => 'priceCurrency',
    'content'  => $currentCurrency->iso_4217
]);

$priceSpan = \yii\helpers\Html::tag('span', $formattedPrice, [
    'class'    => 'full-price',

]);

$hiddenPriceSpan = \yii\helpers\Html::tag('span', '', [
    'itemprop' => 'price',
    'content'  => $price
]);
?>
<div itemscope="" itemtype="http://schema.org/Offer" itemprop="offers">
    <?
    echo $hiddenCurrencySpan . $hiddenPriceSpan;

    if ($currentCurrency->show_after_price) {
        echo $priceSpan . ' ' . $currencySpan;
    }
    else {
        echo $currencySpan . ' ' . $priceSpan;
    }

    ?>
</div>
