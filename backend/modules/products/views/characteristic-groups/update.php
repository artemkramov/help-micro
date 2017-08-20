<?php

use yii\helpers\Html;
use backend\components\BreadcrumbHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\CharacteristicGroup */

BreadcrumbHelper::set($this, \yii\helpers\ArrayHelper::merge(\backend\models\CharacteristicGroup::getLabels(), [
    'type'        => 'update',
    'customTitle' => $model->getCharacteristicGroupTitle()
]), $model);
?>
<div class="characteristic-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
