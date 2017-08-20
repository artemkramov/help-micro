<?php

use common\modules\i18n\Module;

/**
 * @var string $keywords
 * @var string $title
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'search'
], null);
?>
<div>
    <h1><?= $title ?></h1>
    <p><?= Module::t('No results matching the query:') . ' ' . $keywords ?></p>
</div>
