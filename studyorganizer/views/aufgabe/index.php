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

            'Titel',
            [
                'attribute' => 'FachID',
                'value' => function($model) {
                    return $model->fach ? $model->fach->Fachname : '-';
                }
            ],
            'Beschreibung:ntext',
            [
                'attribute' => 'DueDate',
                'format' => 'html',
                'value' => function($model) {
                    $formatted = Yii::$app->formatter->asDate($model->DueDate, 'php:d.m.Y H:i');
                    $badgeClass = $model->getDueDateBadgeClass();
                    return $badgeClass ? "<span class='$badgeClass'>$formatted</span>" : $formatted;
                }
            ],
            [
                'attribute' => 'Finished',
                'format' => 'html',
                'value' => function($model) {
                    return $model->Finished ? '<span class="badge bg-success">Erledigt</span>' : '<span class="badge bg-secondary">Offen</span>';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {finish} {delete}',
                'buttons' => [
                    'finish' => function ($url, $model) {
                        if (!$model->Finished) {
                            return Html::a('<i class="bi bi-check-circle"></i>', ['finish', 'AufgabeID' => $model->AufgabeID], [
                                'title' => 'Als erledigt markieren',
                                'data-confirm' => 'Möchtest du diese Aufgabe als erledigt markieren?',
                                'data-method' => 'post',
                            ]);
                        }
                        return '';
                    },
                    'update' => function ($url, $model) {
                        if ($model->Finished) {
                            return ''; // Keine Bearbeitung für erledigte Aufgaben
                        }
                        return Html::a('<i class="bi bi-pencil-square"></i>', $url, ['title' => 'Bearbeiten']);
                    },
                ],
                'urlCreator' => function ($action, Aufgabe $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'AufgabeID' => $model->AufgabeID]);
                 }
            ],
        ],
    ]); ?>


</div>
