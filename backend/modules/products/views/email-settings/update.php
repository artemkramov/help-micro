<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model common\models\EmailSetting */

$labels = \common\models\EmailSetting::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type'        => 'update',
    'customTitle' => \common\modules\i18n\Module::t($labels['singular']),
]), $model);
?>
<div class="email-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
