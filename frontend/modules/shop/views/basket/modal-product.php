<?

use yii\helpers\Html;
use common\modules\i18n\Module;

/**
 * @var \backend\models\Product $product
 * @var integer $count
 * @var \backend\models\Characteristic $size
 */

?>

<div class="basket-table-wrap">
    <p><?= Module::t('You have added to the basket:') ?></p>
    <span class="line-break"></span>
    <table class="basket-table">
        <tbody>
        <tr>
            <td><?= Html::img($product->getDefaultImage(), [
                    'class' => 'basket-table-image'
                ]) ?></td>
            <td>
                <p><?= $product->title ?></p>
                (<?= $product->vendor_code ?>)
            </td>

            <td>x<?= $count ?></td>
            <td><?= $size->title ?></td>
            <td><?= $product->getPriceTotal($size->id, $count, true) ?></td>
        </tr>
        </tbody>
    </table>
    <span class="line-break"></span>
    <div class="basket-modal-buttons clearfix">
        <?= Html::a(Module::t('Continue shopping'), '#', [
            'class' => 'btn btn-white btn-uppercase btn-continue-shopping'
        ]) ?>
        <?= Html::a(Module::t('Basket'), \frontend\components\FrontendHelper::formLink('/basket/index'), [
            'class' => 'btn btn-black btn-uppercase'
        ]) ?>

    </div>
</div>