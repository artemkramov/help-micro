<?php

use yii\helpers\Html;

/**
 * @var \common\models\Magazine $magazine
 * @var integer $page
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'magazine',
], $magazine);

$pages = $magazine->magazineItems;

?>

<div id="canvas">

    <div class="zoom-icon zoom-icon-in"></div>

    <div class="magazine-viewport">
        <div class="container">
            <div class="magazine">
                <!-- Next button -->
                <div ignore="1" class="next-button"></div>
                <!-- Previous button -->
                <div ignore="1" class="previous-button"></div>
                <? if (!empty($pages)): ?>
                    <? $pairs = array_chunk($pages, 2); ?>
                    <? foreach ($pairs as $counter => $pair): ?>
                        <div>
                            <div class="gradient"></div>
                            <?= Html::img($pair[0]->image) ?>
                        </div>
                        <? if (count($pair) > 1): ?>
                            <div>
                                <div class="gradient"></div>
                                <?= Html::img($pair[1]->image) ?>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>


