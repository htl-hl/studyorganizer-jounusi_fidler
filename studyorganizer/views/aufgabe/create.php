<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = 'Neue Aufgabe erstellen';
$this->params['breadcrumbs'][] = ['label' => 'Meine Aufgaben', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgabe-create mt-4">

    <?= $this->render('_form', [
            'model' => $model,
    ]) ?>

</div>