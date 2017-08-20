<?php

use \common\modules\i18n\Module;

/**
 * @var \backend\models\Product $product
 * @var string $table
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'product',
], $product);

?>
<div class="">
    <?= $table ?>
</div>
