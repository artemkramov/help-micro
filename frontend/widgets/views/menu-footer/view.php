<?

use common\modules\i18n\Module;

/**
 * @var array $menuBlocks
 */

?>
<div class="vc_row wpb_row vc_row-fluid footer-links-title-wrap footer-link-useful" data-tag="footer-column-0">
    <div class="wpb_column vc_column_container vc_col-sm-12 footer-column-useful">
        <div class="footer-links-title vc_toggle vc_toggle_square vc_toggle_color_default  vc_toggle_size_sm">
            <?= Module::t('Useful Information') ?>
            <i class="vc_toggle_icon footer-menu-icon"></i>
        </div>
    </div>
</div>
<div class="vc_row wpb_row vc_row-fluid footer-menu-list-wrapper">
    <?
    foreach ($menuBlocks as $counter => $menuBlock) { ?>
        <div class="wpb_column vc_column_container vc_col-sm-6 footer-column">
            <? if ($counter > 1) break;
            echo $this->render('_block', [
                'menuCollection' => $menuBlock,
                'counter'        => $counter
            ]); ?>
        </div>
    <? } ?>
</div>
