<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = Yii::t('app', 'Update Aufgabe: {name}', [
    'name' => $model->AufgabeID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AufgabeID, 'url' => ['view', 'AufgabeID' => $model->AufgabeID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aufgabe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
