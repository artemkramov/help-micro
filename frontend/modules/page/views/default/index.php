<?

/**
 * @var \common\models\Post $post
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

?>
<!-- article -->
<article id="post-<?= $post->id ?>" class="post-<?= $post->id ?> page type-page status-publish hentry">
    <? echo \frontend\widgets\BreadcrumbWidget::widget([
        'model' => $post,
        'type'  => 'page'
    ]);?>
    <h1 class="post-title"><?= $post->title ?></h1>
    <div class="post-content">
        <?= $post->content ?>
    </div>
</article>
<!-- /article -->