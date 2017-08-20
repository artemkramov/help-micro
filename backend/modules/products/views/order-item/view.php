<?
use yii\bootstrap\Html;
use common\modules\i18n\Module;
use backend\models\Characteristic;

/**
 * @var string $attribute
 * @var array $attributesData
 * @var string $counter
 * @var \common\models\OrderItem $model
 */

?>
<div class="panel panel-default panel-item" data-item="<?= $attribute ?>" data-counter="<?= $counter ?>">
    <div class="panel-body">
        <? if ($counter >= $min || !is_numeric($counter)): ?>
            <div class="clearfix">
                <div class="btn btn-danger btn-delete-bean pull-right">
                    <i class="glyphicon glyphicon-remove"></i>
                </div>
            </div>
        <? endif; ?>
        <div class="row">
            <div class="col-sm-6">
                <?= \backend\widgets\related_bean\RelatedBean::widget([
                    'label'           => Module::t('Product'),
                    'controllerPopup' => '/products/products/popup',
                    'controllerView'  => '/products/products/view',
                    'inputName'       => $attributesData['product_id']['name'],
                    'labelField'      => 'title',
                    'relatedBean'     => $model->product,
                    'options'         => [
                        'id'      => $attributesData['product_id']['id'],
                    ]
                ]) ?>

            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Characteristic') ?></label>
                <div class="form-group field-<?= $attributesData['characteristic_id']['id'] ?>">
                    <?
                    echo Html::dropDownList($attributesData['characteristic_id']['name'], $model->characteristic_id, Characteristic::getSizesList(), ['class' => 'form-control', 'id' => $attributesData['characteristic_id']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Count') ?></label>
                <div class="form-group field-<?= $attributesData['count']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['count']['name'], $model->count, ['class' => 'form-control', 'id' => $attributesData['count']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Price') ?></label>
                <div class="form-group field-<?= $attributesData['price']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['price']['name'], $model->price, ['class' => 'form-control', 'id' => $attributesData['price']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Currency') ?></label>
                <div class="form-group field-<?= $attributesData['currency_id']['id'] ?>">
                    <?
                    echo Html::dropDownList($attributesData['currency_id']['name'], $model->currency_id, \backend\models\Currency::listAll(), ['class' => 'form-control', 'id' => $attributesData['currency_id']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

    </div>
</div>
