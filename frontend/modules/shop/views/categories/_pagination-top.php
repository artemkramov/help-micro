<?php
echo \yii\helpers\Html::hiddenInput('', $dataProvider->getCount());
echo \yii\widgets\LinkPager::widget([
    'pagination'     => $dataProvider->getPagination(),
    'options'        => [
        'class' => 'page-numbers-top'
    ],
    'maxButtonCount' => 6,
    'prevPageLabel'  => '←',
    'nextPageLabel'  => '→'
]);