<?
use yii\bootstrap\Html;
use common\modules\i18n\Module;

/**
 * @var string $attribute
 * @var array $attributesData
 * @var string $counter
 * @var \common\models\Address $model
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
                <label><?= Module::t('First name') ?></label>
                <div class="form-group field-<?= $attributesData['first_name']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['first_name']['name'], $model->first_name, ['class' => 'form-control', 'id' => $attributesData['first_name']['id']]);

                    ?>
                    <div class="help-block"></div>
                </div>

            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Last name') ?></label>
                <div class="form-group field-<?= $attributesData['last_name']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['last_name']['name'], $model->last_name, ['class' => 'form-control', 'id' => $attributesData['last_name']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Phone') ?></label>
                <div class="form-group field-<?= $attributesData['phone']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['phone']['name'], $model->phone, ['class' => 'form-control', 'id' => $attributesData['phone']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Country') ?></label>
                <div class="form-group field-<?= $attributesData['country_id']['id'] ?>">
                    <?
                    echo Html::dropDownList($attributesData['country_id']['name'], $model->country_id, \common\models\Country::getDropdownList(),
                         ['class' => 'form-control', 'id' => $attributesData['country_id']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Region') ?></label>
                <div class="form-group field-<?= $attributesData['region']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['region']['name'], $model->region, ['class' => 'form-control', 'id' => $attributesData['region']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('City') ?></label>
                <div class="form-group field-<?= $attributesData['city']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['city']['name'], $model->city, ['class' => 'form-control', 'id' => $attributesData['city']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Street') ?></label>
                <div class="form-group field-<?= $attributesData['street']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['street']['name'], $model->street, ['class' => 'form-control', 'id' => $attributesData['street']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Building') ?></label>
                <div class="form-group field-<?= $attributesData['building']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['building']['name'], $model->building, ['class' => 'form-control', 'id' => $attributesData['building']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('Flat') ?></label>
                <div class="form-group field-<?= $attributesData['flat']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['flat']['name'], $model->flat, ['class' => 'form-control', 'id' => $attributesData['flat']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Zip') ?></label>
                <div class="form-group field-<?= $attributesData['zip']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['zip']['name'], $model->zip, ['class' => 'form-control', 'id' => $attributesData['zip']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

    </div>
</div>
