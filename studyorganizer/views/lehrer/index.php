<?php

use app\models\Lehrer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LehrerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lehrers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lehrer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Lehrer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Name',
            'Email:email',
            [
                'attribute' => 'IsActive',
                'format' => 'html',
                'value' => function($model) {
                    return $model->IsActive ? '<span class="badge bg-success">Aktiv</span>' : '<span class="badge bg-danger">Inaktiv</span>';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {toggle-active}',
                'buttons' => [
                    'toggle-active' => function ($url, $model) {
                        $label = $model->IsActive ? '<i class="bi bi-x-circle"></i>' : '<i class="bi bi-check-circle"></i>';
                        $title = $model->IsActive ? 'Deaktivieren' : 'Aktivieren';
                        return Html::a($label, ['toggle-active', 'LehrerID' => $model->LehrerID], [
                            'title' => $title,
                            'data-confirm' => "Möchtest du diesen Lehrer {$title}?",
                            'data-method' => 'post',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, Lehrer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'LehrerID' => $model->LehrerID]);
                 }
            ],
        ],
    ]); ?>


</div>
