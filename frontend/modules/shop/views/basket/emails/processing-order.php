<?php

use common\modules\i18n\Module;
use yii\helpers\Html;

/**
 * @var \common\models\Order $order
 */

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td valign="top" style="padding: 48px">
            <div id="body_content_inner" style="color: #333;
                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px;
                line-height: 150%; text-align: left;">
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= Module::t('Thanks!') ?>
                </p>
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= Module::t('Your order is accepted!') ?>!
                </p>
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= Module::t('Our manager will contact you') ?>!
                </p>
                <h2 style="color: #316E46; display: block; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial,
                        sans-serif; font-size: 18px; font-weight: bold; line-height: 130%;
                        margin: 16px 0 8px; text-align: left;">
                    <?= Module::t('Order') ?> #<?= $order->id ?>
                </h2>
                <table class="td" cellspacing="0" cellpadding="6"
                       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                       color: #333; border: 1px solid #316E46;"
                       border="1">
                    <thead>
                    <tr>
                        <th class="td" scope="col"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= Module::t('Product') ?>
                        </th>
                        <th class="td" scope="col"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= Module::t('Count') ?>
                        </th>
                        <th class="td" scope="col"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= Module::t('Price') ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($order->orderItems as $item): ?>
                        <tr class="order-item">
                            <td class="td" style="text-align: center; vertical-align: middle; border: 1px solid #316E46;
                                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                                word-wrap: break-word; color: #333; padding: 12px;">
                                <div style="margin-bottom: 5px;">
                                    <img
                                        src="<?= \yii\helpers\Url::to($item->product->getDefaultImage(), true)?>"
                                        alt="Зображення товару" height="100%" width="100%"
                                        style="vertical-align: middle; margin-right: 10px; border: none;
                                        display: inline; font-size: 14px; font-weight: bold; max-width: 150px;
                                        line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize;">
                                </div>
                                <?= $item->product->title ?>(#<?= $item->product->vendor_code ?>)
                                <br>
                                <small>
                                    <?= $item->characteristic->group->title ?>:
                                    <?= $item->characteristic->title ?>
                                </small>
                            </td>
                            <td class="td" style="text-align: left; vertical-align: middle; border: 1px solid #316E46;
                                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; color: #333;
                                padding: 12px;">
                                <?= $item->count ?>
                            </td>
                            <td class="td" style="text-align: left; vertical-align: middle; border: 1px solid #316E46;
                                font-family: 'Helvetica Neue', Helvetica,Roboto, Arial, sans-serif; color: #333;
                                padding: 12px;">
                                <span class="amount">
                                    <?= $item->getFormattedPrice() ?>
                                </span>
                            </td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="td" scope="row" colspan="2"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= Module::t('Payment type') ?>:
                        </th>
                        <td class="td"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= $order->paymentType->title ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="td" scope="row" colspan="2"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <?= Module::t('In total') ?>:
                        </th>
                        <td class="td"
                            style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;">
                            <span class="amount">
                                <?= $order->getTotalPrice(true) ?>
                            </span>
                        </td>
                    </tr>
                    </tfoot>
                </table>
                <h2 style="color: #316E46; display: block;
                    font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px;
                    font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">
                    <?= Module::t('Information about the client') ?>
                </h2>
                <table class="td" cellspacing="0" cellpadding="6"
                       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                           color: #333; border: 1px solid #316E46;"
                       border="1">
                    <tbody>
                    <tr>
                        <td style="padding: 12px;">
                            <strong>Email:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->email ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Phone') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->phone ?>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <h2 style="color: #316E46; display: block;
                    font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px;
                    font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">
                    <?= Module::t('Address book') ?>
                </h2>
                <table class="td" cellspacing="0" cellpadding="6"
                       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                           color: #333; border: 1px solid #316E46;"
                       border="1">
                    <tbody>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Country') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <? $field = 'title_' . \common\models\Lang::getCurrent()->url; ?>
                                <?= $order->address->country->{$field} ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Region') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->region ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('City') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->city ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Street') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->street ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Building') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->building ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 12px;">
                            <strong><?= Module::t('Flat') ?>:</strong>
                        </td>
                        <td style="padding: 12px;">
                            <span class="text"
                                  style="color: #333; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                                <?= $order->address->flat ?>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <? if (!empty($order->notes)): ?>
                    <h2 style="color: #316E46; display: block;
                    font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 18px;
                    font-weight: bold; line-height: 130%; margin: 16px 0 8px; text-align: left;">
                        <?= Module::t('Notes') ?>
                    </h2>
                    <table class="td" cellspacing="0" cellpadding="6"
                           style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                           color: #333; border: 1px solid #316E46;"
                           border="1">
                        <tbody>
                        <tr>
                            <td style="padding: 12px;">
                                <strong><?= $order->notes ?></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <? endif; ?>
            </div>
        </td>
    </tr>
    </tbody>
</table>

