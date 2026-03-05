<?php

use app\models\Fach;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FachSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Faches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Fach'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
