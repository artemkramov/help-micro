<?php
use yii\helpers\Html;
use common\modules\i18n\Module;

/* @var $this yii\web\View */
/* @var $order \frontend\models\PasswordResetRequestForm */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['cabinet/default/reset-password', 'token' => $order->user->password_reset_token]);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
    <tr>
        <td valign="top" style="padding: 48px">
            <div id="body_content_inner" style="color: #333;
                font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px;
                line-height: 150%; text-align: left;">
                <div class="password-reset">
                    <p><?= Module::t('Hello') ?> <?= Html::encode($order->user->username) ?>,</p>

                    <p><?= Module::t('Follow the link below to reset your password:') ?></p>

                    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
