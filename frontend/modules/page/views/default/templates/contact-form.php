<? $form = \yii\bootstrap\ActiveForm::begin([
    'validateOnBlur' => false,
    'options'        => [
        'class' => 'wpcf7-form'
    ]
]); ?>
<?= \common\widgets\Alert::widget(); ?>
    <h2><?= mb_strtoupper(\common\modules\i18n\Module::t('Contact us'), 'UTF-8') ?></h2>
    <hr class="sep"/>

<?= $form->field($model, 'name')->textInput(['class' => 'contact-input']); ?>

<?= $form->field($model, 'email')->textInput(['class' => 'contact-input']); ?>

<?= $form->field($model, 'message')->textarea([
    'class' => 'contact-input',
    'cols'  => 40,
    'rows'  => 10
]) ?>

<?= \yii\helpers\Html::submitInput(\common\modules\i18n\Module::t('Send'), ['class' => 'btn btn-green btn-uppercase']) ?>

<? \yii\bootstrap\ActiveForm::end(); ?>