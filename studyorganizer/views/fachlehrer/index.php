<?php

use app\models\FachLehrer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FachLehrerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Fach Lehrers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fach-lehrer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Fach Lehrer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'FachID',
            'LehrerID',
            'ZugewiesenAm',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, FachLehrer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID]);
                 }
            ],
        ],
    ]); ?>


</div>
