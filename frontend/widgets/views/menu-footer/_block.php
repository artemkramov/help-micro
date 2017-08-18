<?

/**
 * @var array $menuCollection
 * @var string $menuTitle
 * @var integer $counter
 */

$blockTag = 'footer-column-' . $counter;

?>
<ul class="pull-right">
    <? foreach ($menuCollection as $menu): ?>
        <? if (!$menu['enabled']) continue; ?>
        <li>
            <?
            /**
             * @var \common\models\Menu $item
             */
            $item = \common\models\Menu::findOne($menu['id']);
            ?>
            <a href="<?= $item->getUrl() ?>">
                <?= $menu['title'] ?>
            </a>
        </li>
    <? endforeach; ?>
</ul>