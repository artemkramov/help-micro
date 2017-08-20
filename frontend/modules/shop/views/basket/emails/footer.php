<?php

use yii\helpers\Html;

$emailSetting = \common\models\EmailSetting::find()->one();

/**
 * @var string $directoryAsset
 */

?>
<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
    <tbody>
    <tr>
        <td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
            <table border="0" cellpadding="10" cellspacing="0" width="100%">
                <tbody>
                <tr>
                    <td colspan="2" valign="middle" id="credit" style="padding: 0 48px 48px 48px;
                            -webkit-border-radius: 6px; border: 0; color: #95b0bf; font-family: Arial;
                            font-size: 12px; line-height: 125%; text-align: center;">
                        <?= $emailSetting->footer ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
