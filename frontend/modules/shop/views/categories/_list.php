<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\modules\i18n\Module;

/**
 * @var \backend\models\Product $model
 * @var string $type
 */

$discount = $model->getActionDiscount();
$frontImage = $model->getFrontImage();

?>

<div class="item col-sm-4 col-lg-4">
    <div class="thumbnail">
        <a href="<?= $model->getUrl() ?>">
            <img src="<?= $model->getDefaultImage() ?>" alt="" class="default-image"/>
        </a>
        <div class="caption">
            <h4 class="group inner list-group-item-heading"><?= $model->title ?></h4>
            <?= $model->short_description ?>
            <p>
                <a class="btn btn-success btn-buy-link" data-item="<?= $model->id ?>" href="#"
                   target="_blank"><?= Module::t('Buy') ?></a>
                <a class="btn btn-danger" href="<?= $model->getUrl() ?>">
                    <?= Module::t('More') ?></a>
            </p>
            <div class="row"></div>
        </div>
    </div>
</div>