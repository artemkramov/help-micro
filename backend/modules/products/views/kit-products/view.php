<?

use common\modules\i18n\Module;

/**
 * @var string $attribute
 * @var array $attributesData
 * @var
 */

?>
<div class="panel panel-default panel-item" data-item="<?= $attribute ?>"
     data-counter="<?= $counter ?>">
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
                        'id' => $attributesData['product_id']['id'],
                    ]
                ]) ?>

            </div>
        </div>
    </div>
</div>