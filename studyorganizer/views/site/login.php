<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-10">

            <div class="site-login">

                <div class="row">
                    <div class="col-lg-5">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>

                            <?= Html::button('Sign Up', [
                                    'class' => 'btn btn-primary',
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

            // WICHTIG: Ein frisches User-Model für die Datenbank-Werte
            $signupModel = new \app\models\User();

            // WICHTIG: Eine neue Variable ($signupForm) nutzen, um Konflikte zu vermeiden
            $signupForm = ActiveForm::begin([
                    'id' => 'signup-form',
                    'action' => ['site/signup'],
                    'method' => 'post',
            ]); ?>

            <?= $signupForm->field($signupModel, 'email')->textInput() ?>

            <?= $signupForm->field($signupModel, 'name')->textInput() ?>

            <?= $signupForm->field($signupModel, 'password_hash')->passwordInput()->label('Passwort') ?>

            <div class="form-group mt-3">
                <?= Html::submitButton('Registrieren', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <?php Modal::end(); ?>

            <div style="color:#999;", class="col-lg-5">
                You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                To modify the username/password, please check out the code <code>app\models\User::$users</code>.
            </div>

        </div>
    </div>
</div>
