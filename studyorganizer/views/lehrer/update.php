<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lehrer $model */

$this->title = Yii::t('app', 'Update Lehrer: {name}', [
    'name' => $model->Name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lehrers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'LehrerID' => $model->LehrerID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lehrer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
