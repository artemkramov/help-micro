<?

use common\modules\i18n\Module;

/**
 * @var string $content
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'checkout'
], null);

?>

<article>
    <div class="vc_row wpb_row vc_row-fluid checkout-title">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <h1><?= Module::t('Checkout') ?></h1>
        </div>
    </div>
    <div class="vc_row wpb_row vc_row-fluid checkout-title">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <p><?= Module::t('Congratulations! You have placed your order.') ?></p>
            <p><?= $content ?></p>
        </div>
    </div>
</article>
