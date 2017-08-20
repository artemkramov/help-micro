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
                <label><?= Module::t('Name') ?></label>
                <div class="form-group field-<?= $attributesData['name']['id'] ?>">
                    <?
                    echo Html::textInput('ProductFile[' . $counter . '][name]', $model->name, ['class' => 'form-control field-name', 'id' => $attributesData['name']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Sort') ?></label>
                <div class="form-group field-<?= $attributesData['sort']['id'] ?>">
                    <?
                    echo Html::textInput('ProductFile[' . $counter . '][sort]', $model->sort, ['class' => 'form-control field-sort', 'id' => $attributesData['sort']['id']]);
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label><?= Module::t('File') ?></label>
                <div class="form-group field-<?= $attributesData['file']['id'] ?>">
                    <? if (isset($model->id)): ?>
                        <a class="" rel="group" href="<?= \yii\helpers\Url::to($model->file) ?>"
                           target="_blank">
                            <?= basename($model->file) ?>
                            <?= Html::hiddenInput('ProductFile[' . $counter . '][document]', $model->file) ?>
                        </a>
                        <?

                        ?>
                    <? else: ?>
                        <?
                        echo Html::fileInput('document[' . $counter . ']', '', ['id' => $counter, 'accept' => '']);
                        ?>
                    <? endif; ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
