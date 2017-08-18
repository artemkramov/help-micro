<?php

/**
 * @var \common\models\BlogPost $model
 */

?>

<div class="blog-post-block">
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-5 blog-post-block-image">
            <a href="<?= $model->getUrl() ?>">
                <img class="" src="<?= $model->getDefaultImage() ?>"/>
            </a>
        </div>
        <div class="wpb_column vc_column_container vc_col-sm-7 blog-post-block-inner">
            <div class="blog-post-block-title">
                <a href="<?= $model->getUrl() ?>">
                    <?= $model->title ?>
                </a>
            </div>
            <div class="blog-post-block-description">
                <?= strip_tags($model->short_description) ?>
                <a href="<?= $model->getUrl() ?>" class="blog-post-block-description-more"><?= \common\modules\i18n\Module::t('More')?></a>
            </div>
        </div>
    </div>
</div>
