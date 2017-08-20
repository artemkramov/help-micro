<?

/**
 * @var string $type
 */

?>

<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'viewParams'   => [
        'type' => $type
    ],
    'options'      => [
        'tag'   => 'div',
        'class' => 'products clearfix',
        'id'    => 'products'
    ],
    'itemView'     => '_list',
    'summary'      => '',
    'itemOptions'  => [
        'tag' => false,
    ],
]); ?>

<nav class="woocommerce-pagination">
    <?= \yii\widgets\LinkPager::widget([
        'pagination'     => $dataProvider->pagination,
        'options'        => [
            'class' => 'pagination'
        ],
        'maxButtonCount' => 6,
        'prevPageLabel'  => '←',
        'nextPageLabel'  => '→'
    ]) ?>
</nav>