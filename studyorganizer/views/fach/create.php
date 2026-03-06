<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fach $model */

$this->title = 'Neues Fach erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Fächer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-create mt-4">

    <div class="text-center mb-4">
        <h1 class="display-5"><i class="bi bi-book-half" style="color: #1E90FF;"></i> <?= Html::encode($this->title) ?></h1>
        <p class="text-muted">Lege ein neues Fach für deine Aufgaben an</p>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
