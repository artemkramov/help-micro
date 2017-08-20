<?php

use common\modules\i18n\Module;

/**
 * @var \common\models\Order $order
 */

$preOrder = $order->preOrder;
$url = Yii::$app->params['baseUrl'] . $preOrder->product->getUrl();

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td valign="top" style="padding: 48px">
            <div id="body_content_inner" style="color: #333;
                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px;
                line-height: 150%; text-align: left;">
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= Module::t('Dear') . ' ' . $preOrder->full_name . ','; ?>
                </p>
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= Module::t('Your product is available now!') ?>
                </p>
                <p style="margin: 0 0 5px; font-weight: bold">
                    <?= sprintf(Module::t('Go to the product card for selling it.!'),
                        \yii\helpers\Html::a(Module::t('product card'), $url)); ?>
                </p>
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
                            <?= Module::t('Size') ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="order-item">
                        <td class="td" style="text-align: center; vertical-align: middle; border: 1px solid #316E46;
                                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                                word-wrap: break-word; color: #333; padding: 12px;">
                            <a href="<?= $url ?>">
                                <div style="margin-bottom: 5px;">
                                    <img
                                        src="<?= Yii::$app->params['baseUrl'] . $preOrder->product->getDefaultImage(); ?>"
                                        alt="Зображення товару" height="100%" width="100%"
                                        style="vertical-align: middle; margin-right: 10px; border: none;
                                        display: inline; font-size: 14px; font-weight: bold; max-width: 150px;
                                        line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize;">
                                </div>
                                <?= $preOrder->product->title ?>(#<?= $preOrder->product->vendor_code ?>)
                            </a>
                        </td>
                        <td class="td" style="text-align: left; vertical-align: middle; border: 1px solid #316E46;
                                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; color: #333;
                                padding: 12px;">
                            <?= $preOrder->size->title ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>