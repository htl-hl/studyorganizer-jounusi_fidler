<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = 'Neue Aufgabe erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Meine Aufgaben', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgabe-create mt-4">

    <div class="text-center mb-4">
        <h1 class="display-5"><i class="bi bi-plus-circle" style="color: #1E90FF;"></i> <?= Html::encode($this->title) ?></h1>
        <p class="text-muted">Füge eine neue Aufgabe zu deinem Lernplan hinzu</p>
    </div>

    <?= $this->render('_form', [
            'model' => $model,
    ]) ?>

</div>