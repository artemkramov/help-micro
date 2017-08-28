<?php

use common\modules\i18n\Module;

/**
 * @var \common\models\Post $post
 * @var \frontend\models\ContactForm $contactForm
 */

echo \frontend\components\SeoHelper::setTitle($this, [
    'type' => 'post'
], $post);

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? echo \frontend\widgets\BreadcrumbWidget::widget([
                    'model' => $post,
                    'type'  => 'page'
                ]);?>
            </div>
        </div>

    </div>

    <div class="center">
        <h1><?= $post->title ?></h1>
        <p class="lead"><?= Module::t('Contact page address') ?></p>
    </div>
    <div id="map"></div>
</section>

<section id="contact-page">
    <div class="container">
        <div class="center">
            <h2><?= Module::t('Leave your message') ?></h2>
        </div>
        <div>
            <? $form = \yii\bootstrap\ActiveForm::begin([
                'validateOnBlur' => false,
                'options'        => [
                    'class' => 'contact-form'
                ]
            ]); ?>
            <?= \common\widgets\Alert::widget(); ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($contactForm, 'name')->textInput(['class' => 'form-control']); ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($contactForm, 'email')->textInput(['class' => 'form-control']); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($contactForm, 'message')->textarea([
                        'class' => 'form-control',
                        'cols'  => 40,
                        'rows'  => 10
                    ]) ?>
                </div>
            </div>

            <?= \yii\helpers\Html::submitInput(\common\modules\i18n\Module::t('Send'), ['class' => 'btn btn-primary btn-lg']) ?>

            <? \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</section>

<script>

    function initMap() {
        var uluru = {lat: 50.403129, lng: 30.633483};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: uluru,
            scrollwheel: false,
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }

</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCy9hbm9Xrx8wdQNip5nRR99QWdV3HTk4Q&callback=initMap">
</script>