<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\FachLehrer $model */

$this->title = Yii::t('app', 'Create Fach Lehrer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fach Lehrers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-lehrer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
