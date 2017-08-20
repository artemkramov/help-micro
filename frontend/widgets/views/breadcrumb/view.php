<?php

/**
 * @var array $items
 */

$position = 0;

?>

<div class="breadcrumbs-wrapper">
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="btn-group btn-breadcrumb">
        <? foreach ($items as $item): ?>
            <? $position++; ?>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="btn btn-danger">
                <a itemprop="item" href="<?= $item['url'] ?>">
                    <? if ($position == 1): ?>
                        <i class="glyphicon glyphicon-home"></i>
                        <span itemprop="name" class="hidden"><?= $item['title'] ?></span>
                    <? else: ?>
                        <span itemprop="name"><?= $item['title'] ?></span>
                    <? endif; ?>
                </a>
                <meta itemprop="position" content="<?= $position ?>"/>
            </li>
        <? endforeach; ?>
    </ol>
</div>
