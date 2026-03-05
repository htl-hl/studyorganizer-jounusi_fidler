<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\FachLehrer $model */

$this->title = $model->FachID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fach Lehrers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fach-lehrer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'FachID',
            'LehrerID',
            'ZugewiesenAm',
        ],
    ]) ?>

</div>
