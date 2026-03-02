<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Aufgabe $model */

$this->title = $model->AufgabeID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aufgabes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aufgabe-view">

    <h1><?= Html::encode($model->Titel) ?></h1>

    <p>
        <?php if (!$model->Finished): ?>
            <?= Html::a('Als erledigt markieren', ['finish', 'AufgabeID' => $model->AufgabeID], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Möchtest du diese Aufgabe als erledigt markieren?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'AufgabeID' => $model->AufgabeID], ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            <span class="badge bg-success fs-5">Diese Aufgabe ist erledigt und kann nicht mehr bearbeitet werden</span>
        <?php endif; ?>

        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'AufgabeID' => $model->AufgabeID], [
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
            'Titel',
            [
                'attribute' => 'Beschreibung',
                'format' => 'ntext',
            ],
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
                'value' => $model->Finished ? '<span class="badge bg-success">Erledigt</span>' : '<span class="badge bg-secondary">Offen</span>'
            ],
            [
                'attribute' => 'FachID',
                'value' => $model->fach ? $model->fach->Fachname : '-',
            ],
            [
                'attribute' => 'UserID',
                'value' => $model->user ? $model->user->Name : '-',
                'visible' => Yii::$app->user->identity->isAdmin(),
            ],
        ],
    ]) ?>

</div>
