<?

/**
 * @var \common\models\Post $post
 * @var \backend\models\Product[] $novelties
 */

use common\modules\i18n\Module;

\frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['themePath']);

?>

<!-- SLIDER -->
<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active" style="background-image: url('<?= $directoryAsset ?>/images/slider/bg1.jpg')">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h1 class="animation animated-item-1"><?= Module::t('Main banner slider 1') ?></h1>
<!--                                <a class="btn-slide animation animated-item-3" href="#">--><?//= Module::t('More') ?><!--</a>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url('<?= $directoryAsset ?>/images/slider/bg2.jpg')">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h1 class="animation animated-item-1"><?= Module::t('Main banner slider 2') ?></h1>
<!--                                <a class="btn-slide animation animated-item-3" href="#">--><?//= Module::t('More') ?><!--</a>-->
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section>
<!-- END SLIDER -->

<!-- FEATURES -->
<section id="feature" >
    <div class="container">
        <div class="center wow fadeInDown">
            <h2><?= Module::t('Our advantages') ?></h2>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-handshake-o"></i>
                        <h2><?= Module::t('Years of experience') ?></h2>
                        <h3><?= Module::t('We work in the market more than 10 year')?></h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-line-chart"></i>
                        <h2><?= Module::t('Modern approach') ?></h2>
                        <h3><?= Module::t('We use innovative approach for tasks solutions') ?></h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-globe"></i>
                        <h2><?= Module::t('Versatility') ?></h2>
                        <h3><?= Module::t('We develop devices due to requirements of different countries') ?></h3>
                    </div>
                </div><!--/.col-md-4-->

            </div><!--/.services-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#feature-->
<!-- END FEATURES -->

<!-- RECENT WORKS -->
<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2><?= Module::t('Novelties') ?></h2>
        </div>

        <div class="row">
            <? foreach ($novelties as $novelty): ?>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?= $novelty->getDefaultImage() ?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="<?= $novelty->getUrl() ?>"><?= $novelty->title ?></a> </h3>
                            <p class="lead"><?= $novelty->short_description ?></p>
                            <a class="preview" href="<?= $novelty->getUrl() ?>"><i class="fa fa-eye"></i> <?=  Module::t('View') ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <? endforeach; ?>

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#recent-works-->
<!-- END RECENT WORKS -->

<!-- OUR PARTNERS -->
<section id="partner">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2><?= Module::t('Our partners') ?></h2>
        </div>

        <div class="partners">
            <ul>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="<?= $directoryAsset ?>/images/partners/partner1.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="<?= $directoryAsset ?>/images/partners/partner2.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="<?= $directoryAsset ?>/images/partners/partner3.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="<?= $directoryAsset ?>/images/partners/partner4.png"></a></li>
                <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="<?= $directoryAsset ?>/images/partners/partner5.png"></a></li>
            </ul>
        </div>
    </div><!--/.container-->
</section><!--/#partner-->
<!-- END OUR PARTNERS -->