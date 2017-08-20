<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductRelation */

\backend\components\BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\ProductRelation::getLabels(), [
    'type'        => 'update',
    'customTitle' => \common\modules\i18n\Module::t('ID') . ' - ' . $model->id
]), $model);
?>
<div class="product-relation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
