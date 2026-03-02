<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */
/** @var app\models\User $signupModel */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-login">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary me-2']) ?>
                    <?= Html::button('Registrieren', [
                            'class' => 'btn btn-secondary',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#signupModal',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<?php
Modal::begin([
        'title' => '<h4>Neues Konto erstellen</h4>',
        'id' => 'signupModal',
]);

$signupModel = new \app\models\User();
$signupModel->scenario = 'signup';

$signupForm = ActiveForm::begin([
        'id' => 'signup-form',
        'action' => ['site/signup'],
        'method' => 'post',
]);
?>

<?= $signupForm->field($signupModel, 'Name')->textInput() ?>
<?= $signupForm->field($signupModel, 'Email')->textInput() ?>
<?= $signupForm->field($signupModel, 'password')->passwordInput()->label('Passwort') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Registrieren', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
<?php Modal::end(); ?>