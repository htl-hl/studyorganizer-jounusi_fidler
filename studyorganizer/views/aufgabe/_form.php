<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Fach;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */
/** @var yii\widgets\ActiveForm $form */

// Get all subjects for dropdown
$faecher = ArrayHelper::map(Fach::find()->all(), 'FachID', 'Fachname');
?>

<div class="aufgabe-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'p-4 border rounded shadow-sm bg-light']
    ]); ?>

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
            <?= $form->field($model, 'DueDate')->widget(DateTimePicker::class, [
                'options' => ['placeholder' => 'Wähle Datum und Uhrzeit...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:00',
                    'todayHighlight' => true,
                    'startDate' => date('Y-m-d H:i:s'),
                ]
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
