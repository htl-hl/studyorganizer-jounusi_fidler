<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Fach;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */
/** @var yii\widgets\ActiveForm $form */

// Alle Fächer für Dropdown laden
$faecher = ArrayHelper::map(Fach::find()->all(), 'FachID', 'Fachname');
?>

<div class="aufgabe-form">

    <?php $form = ActiveForm::begin([
            'options' => ['class' => 'p-4 border rounded shadow-sm bg-white']
    ]); ?>

    <div class="text-center mb-4">
        <h1 class="display-5"><i class="bi bi-plus-circle" style="color: #1E90FF;"></i> Neue Aufgabe erstellen</h1>
        <p class="text-muted">Füge eine neue Aufgabe zu deinem Lernplan hinzu</p>
    </div>

    <?= $form->field($model, 'Titel')->textInput([
            'maxlength' => true,
            'placeholder' => 'z.B. Mathematik Hausaufgabe'
    ])->label('Aufgabentitel') ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'FachID')->dropDownList($faecher, [
                    'prompt' => 'Wähle ein Fach...'
            ])->label('Fach') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'DueDate')->textInput([
                    'type' => 'datetime-local',
            ])->label('Fälligkeitsdatum') ?>
        </div>
    </div>

    <?= $form->field($model, 'Beschreibung')->textarea([
            'rows' => 4,
            'placeholder' => 'Beschreibe deine Aufgabe...'
    ])->label('Beschreibung (optional)') ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'UserID')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
        <?= $form->field($model, 'Finished')->hiddenInput(['value' => 0])->label(false) ?>
    <?php endif; ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
                ($model->isNewRecord ? 'Aufgabe erstellen' : 'Aufgabe aktualisieren'),
                ['class' => 'btn w-100', 'style' => 'background-color: #1E90FF; color: white;']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>