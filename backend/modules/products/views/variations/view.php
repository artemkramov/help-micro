<?
use yii\bootstrap\Html;
use common\modules\i18n\Module;

?>
<div class="panel panel-default panel-item ui-state-default" data-item="<?= $attribute ?>" data-counter="<?= $counter ?>">
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
                <label><?= Module::t($group->title) ?></label>
                <div class="form-group field-<?= $attributesData['characteristic_id']['id'] ?>">
                    <?
                    echo Html::dropDownList($attributesData['characteristic_id']['name'], $model->characteristic_id, $sizes, ['class' => 'form-control', 'id' => $attributesData['characteristic_id']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('In stock') ?></label>
                <div class="form-group field-<?= $attributesData['in_stock']['id'] ?>">
                    <?
                    echo Html::checkbox($attributesData['in_stock']['name'], $model->in_stock, ['id' => $attributesData['in_stock']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Price') ?></label>
                <div class="form-group field-<?= $attributesData['price']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['price']['name'], $model->price, ['class' => 'form-control', 'id' => $attributesData['price']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Currency') ?></label>
                <div class="form-group field-<?= $attributesData['currency_id']['id'] ?>">
                    <?
                    echo Html::dropDownList($attributesData['currency_id']['name'], $model->currency_id, $currencies, ['class' => 'form-control', 'id' => $attributesData['currency_id']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
