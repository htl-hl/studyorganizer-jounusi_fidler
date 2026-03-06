<?php

use app\models\Fach;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FachSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Fächer verwalten';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-index mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="bi bi-bookmarks" style="color: #1E90FF;"></i> <?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="bi bi-plus-circle"></i> Neues Fach', ['create'], [
            'class' => 'btn btn-lg',
            'style' => 'background-color: #1E90FF; color: white;'
        ]) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FachID',
            'Fachname',
            'Beschreibung:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fach $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'FachID' => $model->FachID]);
                 }
            ],
        ],
    ]); ?>


</div>
