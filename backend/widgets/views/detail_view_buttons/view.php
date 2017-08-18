<?php

use yii\helpers\Html;
use common\modules\i18n\Module;
use \backend\components\SiteHelper;
use \backend\components\AccessHelper;

/** @var $model \common\models\Bean */
?>
<p>
    <?
    if (SiteHelper::checkActionPermission(['update'])) {
        echo Html::a(Module::t('Update'),
            \yii\helpers\Url::to([AccessHelper::formPrimaryUrl('update'), 'id' => $model->id]),
            ['class' => 'btn btn-primary']);
    }
    ?>
    <?
    if (SiteHelper::checkActionPermission(['delete'])) {
        echo Html::a(Module::t('Delete'),
            \yii\helpers\Url::to([AccessHelper::formPrimaryUrl('delete'), 'id' => $model->id]), [
                'class' => 'btn btn-danger',
                'data'  => [
                    'confirm' => Module::t('Are you sure you want to delete this item?'),
                    'method'  => 'post',
                ],
            ]);
    }
    ?>

    <?

    if (method_exists($model, 'getUrl')) {
        $span = Html::tag('i', '', [
            'class' => 'fa fa-desktop'
        ]);
        $btnOptions = [
            'class'  => 'btn btn-warning',
            'target' => '_blank',
        ];
        $title = Module::t('View on the site');
        $url = $model->getUrl();
        try {
            if (!$model->enabled) {
                $title = Module::t('Preview mode');
                $url .= '?previewMode=1';
            }
        }
        catch (\yii\base\UnknownPropertyException $ex) {

        }
        echo Html::a($span . ' ' . $title,
            \yii\helpers\Url::to($url), $btnOptions);
    }

    ?>

    <?
    if (SiteHelper::checkActionPermission(['index'])) {
        echo Html::a(Module::t('Back to list'), AccessHelper::formPrimaryUrl('index'), ['class' => 'btn btn-default']);
    }
    ?>
</p>