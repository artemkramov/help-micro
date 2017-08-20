<?php

use common\modules\i18n\Module;

/**
 * @var array $items
 * @var \backend\models\Category $category
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'cart'
], $this);

?>
<article>
    <?
    echo \frontend\widgets\BreadcrumbWidget::widget([
        'type'       => 'common',
        'commonName' => Module::t('Basket')
    ]);
    ?>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <?= \common\widgets\Alert::widget() ?>
            <h1><?= Module::t('Basket') ?></h1>
            <div class="cart-upper-buttons clear">
                <a href="<?= $category->getUrl() ?>"
                   class="btn btn-white btn-uppercase btn-continue-shopping"><?= Module::t('Continue shopping') ?></a>
                <? if (!empty($items)): ?>
                    <a href="<?= \yii\helpers\Url::to('checkout') ?>"
                       class="btn btn-black btn-uppercase btn-proceed-checkout"><?= Module::t('Proceed checkout') ?></a>
                <? endif; ?>
            </div>
            <? if (!empty($items)): ?>
                <div class="cart-items">
                    <? foreach ($items as $item): ?>
                        <?
                        /**
                         * @var \backend\models\Product $product
                         */
                        $product = $item['product'];
                        /**
                         * @var \backend\models\Characteristic $size
                         */
                        $size = $item['size'];
                        /**
                         * @var \frontend\models\ProductForm $productModel
                         */
                        $productModel = $item['form'];
                        $form = \yii\widgets\ActiveForm::begin([
                            'validateOnBlur' => false,
                            'options' => [
                                'class' => 'product-form'
                            ]
                        ]);
                        ?>
                        <div class="cart-item clear" id="product-<?= $product->id ?>">
                            <div>
                                <a href="<?= $product->getUrl() ?>">
                                    <img src="<?= $product->getDefaultImage() ?>" class="cart-item-image"/>
                                </a>
                            </div>
                            <div class="cart-item-info-wrapper">
                                <div class="cart-item-info">
                                    <h2 class="cart-item-name">
                                        <a href="<?= $product->getUrl() ?>">
                                            <?= $product->title ?>
                                        </a>
                                    </h2>
                                    <div class="cart-item-article">
                                        <?= Module::t('Vendor code') . ': ' . $product->vendor_code ?>
                                    </div>
                                    <div class="cart-item-properties">
                                        <div class="cart-item-size">
                                            <?= $size->title ?>
                                        </div>
                                        <div class="cart-item-color">
                                            <? if (!empty($product->image_color)): ?>
                                                <img src="<?= \yii\helpers\Url::to($product->image_color) ?>"
                                                     alt="<?= $product->getProductColor() ?>"/>
                                            <? else: ?>
                                                <?= $product->getProductColor() ?>
                                            <? endif; ?>
                                        </div>
                                        <div class="cart-item-count">
                                            <?= $form->field($productModel, 'count')->textInput([
                                                'class'       => 'form-input form-input-number form-input-count',
                                                'placeholder' => Module::t('Count'),
                                            ])->label(false) ?>
                                            <?
                                            echo $form->field($productModel, 'hash')->hiddenInput()->label(false);
                                            echo $form->field($productModel, 'size')->hiddenInput()->label(false);
                                            echo $form->field($productModel, 'product')->hiddenInput()->label(false)
                                            ?>
                                        </div>

                                        <div class="cart-item-price-per-unit">
                                            <?= Module::t('Unit price:') . ' ' . $product->getPricePerUnit($size->id, true) ?>
                                        </div>
                                        <div class="cart-item-price-per-unit">
                                            <?= Module::t('Total:') . ' ' . \yii\helpers\Html::tag('span',
                                                $product->getPriceTotal($size->id, $item['count'], true), [
                                                    'class' => 'cart-item-total'
                                                ]) ?>
                                        </div>

                                    </div>
                                    <div class="cart-item-buttons">
                                        <a href="<?= \yii\helpers\Url::to(['delete', 'hash' => $product->getHash($size->id)]) ?>"
                                           title="<?= Module::t('Remove') ?>">
                                        <span
                                            class="btn-cart-item btn-remove"><?= Module::t('Remove') ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? \yii\widgets\ActiveForm::end(); ?>
                    <? endforeach; ?>
                </div>
                <div class="clear">
                    <div class="cart-total">
                        <h2><?= Module::t('Sum in the basket') ?></h2>
                        <table class="shop-table shop-table-responsive">
                            <tbody>
                            <tr>
                                <td><?= Module::t('In total') ?></td>
                                <td>
                                    <span class="basket-total"><?= \Yii::$app->basket->getBasketCost(true) ?></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="<?= \yii\helpers\Url::to('checkout') ?>"
                           class="btn btn-black btn-uppercase btn-proceed-checkout"><?= Module::t('Proceed checkout') ?></a>
                    </div>
                </div>
            <? else: ?>
                <p><?= Module::t('You basket is empty.') ?></p>
            <? endif; ?>
        </div>
    </div>
</article>
