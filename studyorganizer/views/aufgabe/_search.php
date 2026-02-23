<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AufgabeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aufgabe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AufgabeID') ?>

    <?= $form->field($model, 'Titel') ?>

    <?= $form->field($model, 'Beschreibung') ?>

    <?= $form->field($model, 'DueDate') ?>

    <?= $form->field($model, 'Finished') ?>

    <?php // echo $form->field($model, 'UserID') ?>

    <?php // echo $form->field($model, 'FachID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
