<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
/** @var $currentLanguage \common\models\Lang */

use yii\helpers\Html;

$currentLanguage = \common\models\Lang::getCurrent();
$this->title = \common\modules\i18n\Module::t($name);
?>

<section id="error" class="container text-center">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= \common\modules\i18n\Module::t('The above error occurred while the Web server was processing your request.')?>
    </p>
    <a class="btn btn-primary btn-uppercase" href="<?= Url::base(true) . '/' . $currentLanguage->url ?>"><?= \common\modules\i18n\Module::t('Go back to the homepage') ?></a>
</section><!--/#error-->
