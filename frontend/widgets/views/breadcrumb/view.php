<?php

/**
 * @var array $items
 */

$position = 0;

?>

<div>
    <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs">
        <? foreach ($items as $item): ?>
            <? $position++; ?>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a itemprop="item" href="<?= $item['url'] ?>">
                    <span itemprop="name"><?= $item['title'] ?></span>
                </a>
                <meta itemprop="position" content="<?= $position ?>"/>
            </li>
        <? endforeach; ?>
    </ol>
</div>
