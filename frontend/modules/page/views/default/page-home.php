<?

/**
 * @var \common\models\Post $post
 */

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);


?>
<!-- ARICLE -->
<article id="post-<?= $post->id ?>" class="post-<?= $post->id ?> post-main" style="height: 400px; background: #0b3e6f">

</article>
<!-- END ARTICLE -->