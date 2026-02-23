<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aufgabe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Beschreibung')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'DueDate')->textInput() ?>

    <?= $form->field($model, 'Finished')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'FachID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
