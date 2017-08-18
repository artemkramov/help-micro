<?

use common\modules\i18n\Module;
use common\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var string $directoryAsset
 * @var Setting $setting
 * @var \common\models\Lang $currentLanguage
 */

?>
<header id="header">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-4">
                    <div class="top-number"><p><i class="fa fa-phone-square"></i> <?= $setting->phone ?></p></div>
                </div>
                <div class="col-sm-6 col-xs-8">
                    <div class="social">
                        <div class="js-language">
                            <form method="post" id="footer-select-language" action="<?= \frontend\components\FrontendHelper::formLink('/website/default/change-language') ?>">
                                <?= Html::hiddenInput('pathInfo', Yii::$app->request->pathInfo) ?>
                                <a href="#" class="overlay-link-language"><?= $currentLanguage->name ?> <i class="icon-language flag flag-<?= $currentLanguage->url ?>"></i></a>
                                <?= $this->render('chunks/language', [
                                    'currentLanguage' => $currentLanguage,
                                    'languages'       => \common\models\Lang::find()->where([
                                        '<>', 'id', $currentLanguage->id
                                    ])->all()
                                ]) ?>
                            </form>
                        </div>
                        <div class="search">
                            <form role="form">
                                <input type="text" class="search-form" autocomplete="off"
                                       placeholder="<?= Module::t('Search') ?>">
                                <i class="fa fa-search"></i>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->
    </div><!--/.top-bar-->

    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Url::base(true) . '/' . $currentLanguage->url ?>"><img src="<?= $directoryAsset ?>/images/logo.png" alt="logo"></a>
            </div>


            <div class="collapse navbar-collapse navbar-right">
                <?= \frontend\widgets\MenuTopWidget::widget(); ?>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->

    <!-- MODAL WINDOW -->
    <div class="">
        <?= $this->render('chunks/modal') ?>
    </div>
    <!-- END MODAL WINDOW -->

    <!-- ORGANIZATION INFO -->
    <div class="hidden">
        <div itemscope="" itemtype="http://schema.org/Organization">
            <meta itemprop="telephone" content="<?= $setting->phone ?>" />
            <meta itemprop="url" content="<?= Url::base(true) ?>" />
            <span itemprop="name" content="<?= Yii::$app->name ?>"></span>
        </div>
    </div>
    <!-- END ORGANIZATION INFO -->

    <div>
        <? $javascriptLabels = \common\models\Lang::getJavascriptLabels(); ?>
    </div>

    <script type="text/javascript">
        window.siteUrl = '<?= Yii::$app->request->hostInfo . '/' . $currentLanguage->url ?>';
        window.hostInfo = '<?= Yii::$app->request->hostInfo ?>';
        window.javascriptJSONLabels = '<?= json_encode($javascriptLabels) ?>';
    </script>

</header><!--/header-->
