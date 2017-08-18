<?php

/**
 * @var \common\models\BlogPost $post
 * @var \common\models\Setting $setting
 * @var string $directoryAsset
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'blogPost',
], $post);

echo \frontend\widgets\BreadcrumbWidget::widget([
    'type'  => 'blogPost',
    'model' => $post
]);

$host = rtrim(\yii\helpers\Url::home(true), '/');
$directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['themePath']);
$logo = $host. $directoryAsset . '/img/logo.png';
$imageLogoSize = getimagesize($logo);
$imageSize = getimagesize($host . $post->getDefaultImage());
$setting = \common\models\Setting::find()->one();

?>

<div class="vc_row wpb_row vc_row-fluid" itemscope itemtype="http://schema.org/Article">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div itemprop="mainEntityOfPage" itemid="<?= $host . $post->getDefaultImage() ?>">
            <h1 class="post-title" itemprop="headline"><?= $post->title ?></h1>
        </div>
        <div class="post-content" itemprop="articleBody">
            <div><?= $post->content ?></div>
            <div>
                <a href="<?= \frontend\components\FrontendHelper::formLink($post->blogCategory->getUrl()) ?>"
                   class="btn btn-white btn-uppercase btn-blog-post-back"><?= \common\modules\i18n\Module::t('Back to list') ?></a>
            </div>
        </div>

        <!-- Add extra micro data -->
        <div class="hidden">
            <span itemprop="author"><?= $post->user->username ?></span>
            <span itemprop="datePublished"><?= date('Y-m-d', $post->created_at) ?></span>
            <span itemprop="dateModified"><?= date('Y-m-d', $post->updated_at) ?></span>

            <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <img itemprop="url contentUrl" src="<?= $post->getDefaultImage() ?>" alt="<?= $post->title ?>"/>
                <span itemprop="width" content="<?= $imageSize[0] ?>"></span>
                <span itemprop="height" content="<?= $imageSize[1] ?>"></span>
            </span>

            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <div itemprop="logo image" itemscope itemtype="https://schema.org/ImageObject">
                    <img itemprop="url contentUrl" src="<?= $logo ?>" alt="logo"/>
                    <meta itemprop="width" content="<?= $imageLogoSize[0] ?>"/>
                    <meta itemprop="height" content="<?= $imageLogoSize[1] ?>"/>
                </div>
                <meta itemprop="name" content="<?= Yii::$app->name ?>"/>
                <meta itemprop="telephone" content="<?= $setting->phone ?>"/>
            </div>

        </div>

    </div>
</div>
