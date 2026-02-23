<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FachLehrer $model */

$this->title = Yii::t('app', 'Update Fach Lehrer: {name}', [
    'name' => $model->FachID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fach Lehrers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->FachID, 'url' => ['view', 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fach-lehrer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
