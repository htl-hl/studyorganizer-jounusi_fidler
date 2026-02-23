<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = Yii::t('app', 'Create Aufgabe');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgabe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
