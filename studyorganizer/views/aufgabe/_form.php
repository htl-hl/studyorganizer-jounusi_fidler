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
        <h1 class="display-5"><i class="bi bi-plus-circle" style="color: #1E90FF;"></i> <?= Yii::t('app', 'New task') ?></h1>
        <p class="text-muted"><?= Yii::t('app', 'Add a new task to your learning plan') ?></p>
    </div>

    <?= $form->field($model, 'Titel')->textInput([
            'maxlength' => true,
            'placeholder' => Yii::t('app', 'e.g. Math homework')
    ])->label(Yii::t('app', 'Task title')) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'FachID')->dropDownList($faecher, [
                    'prompt' => Yii::t('app', 'Choose a subject...')
            ])->label(Yii::t('app', 'Subject')) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'DueDate')->textInput([
                    'type' => 'datetime-local',
            ])->label(Yii::t('app', 'Due date')) ?>
        </div>
    </div>

    <?= $form->field($model, 'Beschreibung')->textarea([
            'rows' => 4,
            'placeholder' => Yii::t('app', 'Describe your task...')
    ])->label(Yii::t('app', 'Description (optional)')) ?>

    <?php if ($model->isNewRecord): ?>
        <?= $form->field($model, 'UserID')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
        <?= $form->field($model, 'Finished')->hiddenInput(['value' => 0])->label(false) ?>
    <?php endif; ?>

    <div class="form-group mt-3">
        <?= Html::submitButton(
                ($model->isNewRecord ? Yii::t('app', 'Create task') : Yii::t('app', 'Update task')),
                ['class' => 'btn w-100', 'style' => 'background-color: #1E90FF; color: white;']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>