<?php

use common\modules\i18n\Module;

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'collections'
], null);

/**
 * @var array $items
 */

?>

<?
echo \frontend\widgets\BreadcrumbWidget::widget([
    'model'      => null,
    'type'       => 'collections',
    'commonName' => Module::t('Collections')
]);

?>

<div class="vc_row wpb_row vc_row-fluid">
    <? foreach ($items as $itemsData): ?>
        <? foreach ($itemsData["items"] as $item): ?>
            <div class="wpb_column vc_column_container vc_col-sm-12 collection-block">
                <div class="vc_row wpb_row vc_row-fluid">
                    <div class="wpb_column vc_column_container vc_col-sm-5 collection-block-image">
                        <a href="<?= $item['url'] ?>" target="<?= $item['is_new_tab'] ? '_blank' : '_self' ?>">
                            <img class="" src="<?= $item['image'] ?>"/>
                        </a>
                    </div>
                    <div class="wpb_column vc_column_container vc_col-sm-7 collection-block-inner">
                        <div class="collection-block-title">
                            <a href="<?= $item['url'] ?>" target="<?= $item['is_new_tab'] ? '_blank' : '_self' ?>">
                                <?= $item['name'] ?>
                            </a>
                        </div>
                        <div class="collection-block-description">
                            <?= $item['description'] ?>
                        </div>
                        <? if (!empty($item['campaign'])): ?>
                            <div class="collection-block-campaign">
                                <a href="<?= $item['campaign'] ?>" target="_blank">CAMPAIGN</a>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        <? endforeach;; ?>
    <? endforeach; ?>
</div>
