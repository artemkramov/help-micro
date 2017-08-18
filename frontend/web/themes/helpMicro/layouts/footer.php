<?
use common\modules\i18n\Module;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

?>
<!-- FOOTER -->
<footer id="footer" class="midnight-blue">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                &copy; <?= date('Y') ?> <?=  Yii::$app->name?>. All Rights Reserved.
            </div>
            <div class="col-sm-6">
                <?= \frontend\widgets\MenuFooterWidget::widget() ?>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->
