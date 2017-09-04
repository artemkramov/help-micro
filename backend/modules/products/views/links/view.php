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
                <label><?= Module::t('Title') ?></label>
                <div class="form-group field-<?= $attributesData['title']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['title']['name'], $model->title, ['class' => 'form-control', 'id' => $attributesData['title']['id']]);

                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <label><?= Module::t('Link') ?></label>
                <div class="form-group field-<?= $attributesData['link']['id'] ?>">
                    <?
                    echo Html::textInput($attributesData['link']['name'], $model->link, ['class' => 'form-control', 'id' => $attributesData['link']['id']]);

                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div>
</div>
