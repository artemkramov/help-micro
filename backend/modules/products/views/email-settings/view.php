<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model common\models\EmailSetting */

$labels = \common\models\EmailSetting::getLabels();
BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge($labels, [
    'type'        => 'view',
    'customTitle' => \common\modules\i18n\Module::t($labels['singular']),
]), $model);
?>
<div class="email-setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \backend\widgets\DetailViewButtons::widget([
        'model' => $model
    ]) ?>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            'subject_from',
            'email_from:email',
        ],
    ]) ?>

</div>
