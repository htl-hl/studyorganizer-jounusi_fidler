<?php

use app\models\Aufgabe;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AufgabeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Aufgabes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aufgabe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aufgabe'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AufgabeID',
            'Titel',
            'Beschreibung:ntext',
            'DueDate',
            'Finished',
            //'UserID',
            //'FachID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Aufgabe $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'AufgabeID' => $model->AufgabeID]);
                 }
            ],
        ],
    ]); ?>


</div>
