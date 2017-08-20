<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\i18n\Module;

/* @var $this yii\web\View */
/* @var $model backend\models\ProductRelation */
/* @var $form yii\widgets\ActiveForm */

$reflect = new ReflectionClass($model);
$className = $reflect->getShortName();
$template = $className . "[%s]";

?>

<div class="product-relation-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= \backend\widgets\related_bean\RelatedBean::widget([
                'label'           => Module::t('Product'),
                'controllerPopup' => '/products/products/popup',
                'controllerView'  => '/products/products/view',
                'inputName'       => sprintf($template, 'product_id'),
                'labelField'      => 'title',
                'relatedBean'     => $model->product,
                'options'         => [
                    'id' => 'product_id',
                ]
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= \backend\widgets\related_bean\RelatedBean::widget([
                'label'           => Module::t('Product related'),
                'controllerPopup' => '/products/products/popup',
                'controllerView'  => '/products/products/view',
                'inputName'       => sprintf($template, 'product_related_id'),
                'labelField'      => 'title',
                'relatedBean'     => $model->productRelated,
                'options'         => [
                    'id' => 'product_related_id',
                ]
            ]) ?>
        </div>
    </div>

    <?= \backend\widgets\FormButtons::widget([
        'model' => $model
    ]); ?>

    <?php ActiveForm::end(); ?>

</div>
