<?

use common\modules\i18n\Module;

/**
 * @var array $menuCollection
 */

?>


<ul class="nav navbar-nav">
    <? foreach ($menuCollection as $menu): ?>
        <? if (!$menu['enabled']) continue; ?>
        <?
        $item = \common\models\Menu::findOne($menu['id']);
        $class = [];
        $class[] = array_key_exists('active', $menu) && $menu['active'] ? 'active' : '';
        $isDropdown = array_key_exists('children', $menu);
        if ($isDropdown) {
            $class[] = "dropdown";
        }
        ?>
        <li class="<?= implode(' ', $class) ?>" data-menu="<?= $menu['id'] ?>" data-type="<?= array_key_exists('type', $menu) ? $menu['type'] : '' ?>">

            <?
            /**
             * @var \common\models\Menu $item
             */
            ?>
            <a href="<?= $item->getUrl() ?>" class="<?= $isDropdown ? 'dropdown-toggle' : '' ?>" <?= ($isDropdown) ? 'data-toggle="dropdown"' : '' ?>>
                <?= $menu['title'] ?>
                <? if ($isDropdown): ?>
                    <i class="fa fa-angle-down"></i>
                <? endif; ?>
            </a>
            <? if (array_key_exists('children', $menu)): ?>
                <ul class="dropdown-menu">
                    <? foreach ($menu['children'] as $children): ?>
                        <? if (!$children['enabled']) continue; ?>
                        <li>
                            <? $item = \common\models\Menu::findOne($children['id']); ?>
                            <a href="<?= array_key_exists('directUrl', $children) ? $children['directUrl'] : $item->getUrl() ?>"
                               target="<?= $children['is_new_tab'] ? '_blank' : '_self' ?>">
                                <?= $children['title'] ?>
                            </a>
                        </li>
                    <? endforeach; ?>
                </ul>
            <? endif; ?>
        </li>
    <? endforeach; ?>
</ul>