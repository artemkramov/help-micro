<?

/**
 * @var array $menuCollection
 * @var string $menuTitle
 * @var integer $counter
 */

$blockTag = 'footer-column-' . $counter;

?>
<div class="vc_row wpb_row vc_row-fluid footer-links-menu-wrap <?= $blockTag ?>">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <ul class="footer-list">
            <? foreach ($menuCollection as $menu): ?>
                <? if (!$menu['enabled']) continue; ?>
                <li>
                    <?
                    /**
                     * @var \common\models\Menu $item
                     */
                    $item = \common\models\Menu::findOne($menu['id']);
                    ?>
                    <a href="<?= $item->getUrl() ?>" class="footer-link">
                        <?= $menu['title'] ?>
                    </a>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>