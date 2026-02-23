<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Fach $model */

$this->title = Yii::t('app', 'Create Fach');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
