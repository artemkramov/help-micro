<?php

use common\modules\i18n\Module;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Product;
use common\models\PaymentType;

/**
 * @var array $items
 * @var \common\models\Address $address
 * @var \common\models\Order $order
 * @var \common\models\PaymentType[] $paymentTypes
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'checkout'
], null);


?>
<article>
    <?
    echo \frontend\widgets\BreadcrumbWidget::widget([
        'type'       => 'common',
        'commonName' => Module::t('Checkout')
    ]);
    ?>
    <div class="vc_row wpb_row vc_row-fluid checkout-title">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <h1><?= Module::t('Checkout') ?></h1>
        </div>
    </div>
    <? if (!empty($items)): ?>
        <? $form = ActiveForm::begin(); ?>
        <div class="vc_row wpb_row vc_row-fluid checkout-wrapper">
            <div class="wpb_column vc_column_container vc_col-sm-8">

                <!-- PAYMENT DETAILS START -->
                <div class="checkout-block">
                    <h2 class="checkout-block-title"><?= Module::t('Payment details') ?></h2>
                    <hr/>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'first_name')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'last_name')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($order, 'email')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'phone')->textInput([
                                'class'       => 'form-input',
                                'data-type'   => 'phone',
                                'placeholder' => '(###) ###-##-##',
                            ]) ?>
                        </div>
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'country_id')->dropDownList(\common\models\Country::getDropdownList(), [
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'region')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'city')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'street')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'building')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'flat')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                    </div>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-6">
                            <?= $form->field($address, 'zip')->textInput([
                                'class' => 'form-input'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <!-- PAYMENT DETAILS END -->

                <!-- NOTES START -->
                <div class="checkout-block">
                    <h2 class="checkout-block-title"><?= Module::t('Notes') ?></h2>
                    <hr/>
                    <div class="vc_row wpb_row vc_row-fluid">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <?= $form->field($order, 'notes')->textarea([
                                'class' => 'form-input',
                                'rows'  => 10,
                            ])->label(false) ?>
                        </div>
                    </div>
                </div>
                <!-- NOTES END -->

            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4">
                <?
                echo Html::img('/uploads/checkout_img.jpg', [
                    'class' => 'checkout-image'
                ]);
                ?>
            </div>
        </div>

        <!-- YOUR ORDER START -->
        <div class="vc_row wpb_row vc_row-fluid checkout-your-order">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="checkout-block">
                    <h2 class="checkout-block-title"><?= Module::t('Your order') ?></h2>
                    <hr/>
                    <table class="shop-table shop-order-table">
                        <thead>
                        <tr>
                            <th><?= Module::t('Product') ?></th>
                            <th><?= Module::t('Total price') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <? foreach ($items as $item): ?>
                            <?
                            /**
                             * @var Product $product
                             */
                            $product = $item['product'];

                            /**
                             * @var \backend\models\Characteristic $size
                             */
                            $size = $item['size'];
                            ?>
                            <tr>
                                <td>
                                    <p>
                                        <?= $product->title ?><strong> × <?= $item['count'] ?></strong>
                                    </p>
                                    <p>
                                        <?= $size->group->getCharacteristicGroupTitle() ?>: <?= $size->title ?>
                                    </p>
                                </td>
                                <td>
                                    <p><?= $product->getPriceTotal($size->id, $item['count'], true) ?></p>
                                </td>
                            </tr>
                        <? endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>
                                <strong><?= Module::t('In total') ?></strong>
                            </td>
                            <td>
                                <strong><?= \Yii::$app->basket->getBasketCost(true) ?></strong>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- YOUR ORDER END -->

        <!-- PAYMENT TYPE START -->
        <div class="checkout-payment-type">
            <?= $form->field($order, 'payment_type_id')->radioList(PaymentType::listAllLocalized(), [
                'class' => 'checkout-payment-type-list'
            ])
                ->label(false) ?>
            <div class="hidden checkout-payment-type-description">
                <? foreach ($paymentTypes as $paymentType): ?>
                    <div data-item="payment-type-<?= $paymentType->id ?>">
                        <?= $paymentType->content ?>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <!-- PAYMENT TYPE END -->

        <?= Html::submitButton(Module::t('Place order'), [
            'class' => 'btn btn-black btn-uppercase btn-place-order'
        ]) ?>

        <? ActiveForm::end(); ?>

    <? else: ?>

        <p><?= Module::t('	You basket is empty.') ?></p>

    <? endif; ?>
</article>
