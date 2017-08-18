<?

use common\modules\i18n\Module;

/**
 * @var array $menuBlocks
 */

?>
<?
foreach ($menuBlocks as $counter => $menuBlock) { ?>
    <?
    echo $this->render('_block', [
        'menuCollection' => $menuBlock,
        'counter'        => $counter
    ]); ?>
<? } ?>
