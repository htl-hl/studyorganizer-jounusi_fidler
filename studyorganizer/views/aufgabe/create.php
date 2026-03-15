<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = Yii::t('app', 'New task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgabe-create mt-4">

    <?= $this->render('_form', [
            'model' => $model,
    ]) ?>

</div>