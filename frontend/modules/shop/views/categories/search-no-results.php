<?php

use common\modules\i18n\Module;

/**
 * @var string $keywords
 * @var string $title
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'search'
], null);

echo \frontend\widgets\BreadcrumbWidget::widget([
    'model'      => null,
    'type'       => 'search',
    'commonName' => isset($title) ? $title : ''
]);

?>
<div class="center wow fadeInDown not-visible">
    <h1><?= $title ?></h1>
    <p class="lead">
        <?= Module::t('No results matching the query:') . ' ' . $keywords ?>
    </p>
</div>
