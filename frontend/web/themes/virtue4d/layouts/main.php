<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

\frontend\web\themes\virtue4d\FrontendAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['themePath']);
$templateClass = array_key_exists('template', \Yii::$app->params) ? pathinfo(Yii::$app->params['template'], PATHINFO_FILENAME) : '';

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="copyright" content="<?= Yii::$app->name ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $templateClass ?>">
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= $this->render(
        'header.php',
        [
            'directoryAsset' => $directoryAsset
        ]
    ) ?>

    <?
    $contentView = 'content.php';
    if (array_key_exists('template', \Yii::$app->params)) {
        $contentView = \Yii::$app->params['template'];
    }
    ?>
    <?= $this->render(
        'templates/' . $contentView,
        ['content' => $content, 'directoryAsset' => $directoryAsset]
    ) ?>

</div>
<?= $this->render(
    'footer.php',
    ['directoryAsset' => $directoryAsset]
) ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>