<?

/**
 * @var \common\models\Post $post
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

?>
<? echo \frontend\widgets\BreadcrumbWidget::widget([
    'model' => $post,
    'type'  => 'page'
]); ?>

<div class="center wow fadeInDown not-visible">
    <h1><?= $post->title ?></h1>
    <p class="lead"></p>
</div>
<div class="post-content">
    <?= $post->content ?>
</div>
