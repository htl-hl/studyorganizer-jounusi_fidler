<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Fach $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fach-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'p-4 border rounded shadow-sm bg-light']
    ]); ?>

    <?= $form->field($model, 'Fachname')->textInput([
        'maxlength' => true,
        'placeholder' => 'z.B. Mathematik, Deutsch, Englisch...'
    ])->label('Fachname') ?>

    <?= $form->field($model, 'Beschreibung')->textarea([
        'rows' => 4,
        'placeholder' => 'Beschreibe das Fach (optional)...'
    ])->label('Beschreibung (optional)') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
            ($model->isNewRecord ? 'Fach erstellen' : 'Fach aktualisieren'),
            ['class' => 'btn w-100', 'style' => 'background-color: #1E90FF; color: white;']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
