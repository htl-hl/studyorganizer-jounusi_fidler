<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fach $model */

$this->title = Yii::t('app', 'Update Fach: {name}', [
    'name' => $model->FachID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FachID, 'url' => ['view', 'FachID' => $model->FachID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fach-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
