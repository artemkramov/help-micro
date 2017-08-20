<?php

use common\modules\i18n\Module;

/**
 * @var \frontend\models\ContactForm $order
 */

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td valign="top" style="padding: 48px">
            <div id="body_content_inner" style="color: #333;
                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px;
                line-height: 150%; text-align: left;">
                <table class="td" cellspacing="0" cellpadding="6"
                       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;
                       color: #333; border: 1px solid #316E46;"
                       border="1">
                    <tbody>
                    <tr>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= Module::t('First name') ?>:</td>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= $order->name ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= Module::t('Email') ?>:</td>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= $order->email ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= Module::t('Text') ?>:</td>
                        <td style="text-align: left; color: #333; border: 1px solid #316E46; padding: 12px;"><?= $order->message ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
    </tbody>
</table>
