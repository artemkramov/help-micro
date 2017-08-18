<?

use common\modules\i18n\Module;

/**
 * @var array $menuCollection
 */

?>


<ul class="nav-links">
    <? foreach ($menuCollection as $menu): ?>
        <? if (!$menu['enabled']) continue; ?>
        <li data-menu="<?= $menu['id'] ?>" data-type="<?= array_key_exists('type', $menu) ? $menu['type'] : '' ?>">
            <?
            $item = \common\models\Menu::findOne($menu['id']);
            $classActive = array_key_exists('active', $menu) && $menu['active'] ? 'active' : '';
            if (array_key_exists('bold', $menu) && $menu['bold']) {
                $classActive .= " bold";
            }
            ?>
            <?
            /**
             * @var \common\models\Menu $item
             */
            ?>
            <a href="<?= $item->getUrl() ?>" class="nav-level-1 <?= $classActive ?>">
                <?= $menu['title'] ?>
            </a>
            <? if (array_key_exists('children', $menu)): ?>
                <?
                $childrenData = array_slice(array_chunk($menu['children'], 8), 0, 2);
                $listContainerCount = count($childrenData);
                if (!empty($item->image)) {
                    $listContainerCount++;
                }
                $listContainerWidth = $listContainerCount * 250;
                ?>
                <div class="nav-level-2 visibility-fix template-two-lists" style="width: <?= $listContainerWidth ?>px;"
                     data-column="<?= $listContainerCount ?>">
                    <div class="nav-level-2-inner">
                        <div class="nav-level-2-container max-girdle-width">
                            <div class="nav-level-back"><?= Module::t('Back') ?></div>
                            <span class="line-break"></span>
                            <div class="list-container">
                                <div class="list-container-inner clear">
                                    <? if (!empty($item->image)): ?>
                                        <div class="list-container-image">
                                            <?= \yii\helpers\Html::img(\yii\helpers\Url::to($item->image), [

                                            ]) ?>
                                        </div>
                                    <? endif; ?>
                                    <div class="list-container-item">
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <? foreach ($childrenData as $childrenArray): ?>
                                                <div
                                                    class="wpb_column vc_column_container vc_col-md-<?= count($childrenData) > 1 ? '6' : '12' ?>">
                                                    <ul class="sub-menu">
                                                        <? foreach ($childrenArray as $children): ?>
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
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <? endif; ?>
        </li>
    <? endforeach; ?>
</ul>

<script type="text/template" id="menu-popup-template">
    <div class="menu-popup">
        <div class="menu-popup-inner">
            <div class="vc_row wpb_row vc_row-fluid menu-popup-items">
                <div class="wpb_column vc_column_container vc_col-sm-9">
                    <div class="vc_row wpb_row vc_row-fluid menu-popup-items">
                        <% var cssClass = 12 / blocks.items.length; %>
                        <% _.each(blocks.items, function(block) { %>
                        <div class="wpb_column vc_column_container vc_col-sm-<%= cssClass %>">
                            <div class="menu-popup-title">
                                <a href="<%= block.url %>" class="<%= block.skip ? 'skipped' : '' %>"><%= block.name
                                    %></a>
                            </div>
                            <div class="menu-popup-block">
                                <ul class="sub-menu">
                                    <% _.each(block.items, function(item) { %>
                                    <li>
                                        <a href="<%= item.url %>" target="<%= item.is_new_tab ? '_blank' : '_self'  %>"><%=
                                            item.name %></a>
                                    </li>
                                    <% }); %>
                                </ul>
                            </div>
                        </div>
                        <% }); %>

                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-3">
                    <img src="<%= blocks.image %>" alt="">
                </div>
            </div>
        </div>
    </div>
</script>

<!-- EXTRA TEMPLATE FOR SHOP MENU -->
<script type="text/template" id="menu-popup-template-shop">
    <div class="menu-popup">
        <div class="menu-popup-inner">
            <div class="vc_row wpb_row vc_row-fluid menu-popup-items">
                <div class="wpb_column vc_column_container vc_col-sm-9">

                    <!-- CREATE FIRST TWO COLUMNS WITH WOMEN CLOTHES  -->
                    <div class="vc_row wpb_row vc_row-fluid menu-popup-items">
                        <% var cssClass = 4; %>
                        <% var womanItems = blocks.items[0].items;
                        /**
                        * The count of the positions in the first column
                        */
                        var limitFirstColumn = 12;

                        /**
                        * Columns of women
                        */
                        var womanItemsChunks = [{items: [], title: blocks.items[0].name}, {items: [], title:
                        blocks.items[0].name, skip: true}];
                        var iterations = womanItems.length > limitFirstColumn ? limitFirstColumn : womanItems.length;
                        var i = 0;
                        for (i = 0; i < iterations; i++) {
                        womanItemsChunks[0].items.push(womanItems[i]);
                        }
                        i = 0;
                        for (i = iterations; i < womanItems.length; i++) {
                        womanItemsChunks[1].items.push(womanItems[i]);
                        }
                        %>
                        <% _.each(womanItemsChunks, function(chunk) { %>
                        <div class="wpb_column vc_column_container vc_col-sm-<%= cssClass %>">
                            <div class="menu-popup-title">
                                <a href="<%= blocks.items[0].url %>" class="<%= chunk.skip ? 'skipped' : '' %>"><%=
                                    blocks.items[0].name %></a>
                            </div>
                            <div class="menu-popup-block">
                                <ul class="sub-menu">
                                    <% _.each(chunk.items, function(item) { %>
                                    <li>
                                        <a href="<%= item.url %>" target="<%= item.is_new_tab ? '_blank' : '_self'  %>"><%=
                                            item.name %></a>
                                    </li>
                                    <% }); %>
                                </ul>
                            </div>
                        </div>
                        <% }); %>

                        <!-- SHOW ALL ANOTHER CATEGORIES ON THE ONE COLUMN SIDE BY SIDE  -->
                        <div class="wpb_column vc_column_container vc_col-sm-<%= cssClass %>">
                            <% blocks.items.shift(); %>
                            <% _.each(blocks.items, function(block) { %>
                            <div class="menu-popup-title">
                                <a href="<%= block.url %>" class="<%= block.skip ? 'skipped' : '' %>"><%= block.name %></a>
                            </div>
                            <div class="menu-popup-block">
                                <ul class="sub-menu">
                                    <% _.each(block.items, function(item) { %>
                                    <li>
                                        <a href="<%= item.url %>" target="<%= item.is_new_tab ? '_blank' : '_self'  %>"><%= item.name %></a>
                                    </li>
                                    <% }); %>
                                </ul>
                            </div>
                            <% }); %>
                        </div>

                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-3">
                    <img src="<%= blocks.image %>" alt="">
                </div>
            </div>
        </div>
    </div>
</script>