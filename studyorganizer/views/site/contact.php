<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact mt-4">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="p-4 border rounded shadow-sm bg-white">
            <div class="alert alert-info">
                <?= Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.') ?>
            </div>
        </div>

    <?php else: ?>

        <div class="p-4 border rounded shadow-sm bg-white">
            <div class="text-center mb-4">
                <h1 class="display-5"><i class="bi bi-envelope" style="color: #1E90FF;"></i> <?= Html::encode($this->title) ?></h1>
                <p class="text-muted"><?= Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us.') ?></p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group mt-3">
                        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn w-100', 'style' => 'background-color: #1E90FF; color: white;', 'name' => 'contact-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>

    <?php endif; ?>
</div>
