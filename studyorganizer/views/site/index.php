<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'StudyOrganizer';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulations!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
        <p><a class="btn btn-lg" style="background-color: #1E90FF; color: white;" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if (Yii::$app->user->identity->isAdmin()): ?>
                <!-- Admin Dashboard -->
                <div class="alert alert-info mt-3">
                    <strong>Admin-Bereich</strong> - Du hast vollständigen Zugriff auf alle Funktionen.
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>Fächer verwalten</h4><p>Fächer anlegen und bearbeiten</p>', ['fach/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>Lehrer verwalten</h4><p>Lehrer anlegen und zuordnen</p>', ['lehrer/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>Alle Aufgaben</h4><p>Übersicht über alle Aufgaben</p>', ['aufgabe/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- User Dashboard -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <?= Html::a('<h4>Meine Aufgaben</h4><p>Aufgaben anzeigen und bearbeiten</p>', ['aufgabe/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <?= Html::a('<h4>Neue Aufgabe</h4><p>Neue Aufgabe erstellen</p>', ['aufgabe/create'], ['class' => 'btn btn-primary w-100 p-4 text-start', 'style' => 'background-color: #1E90FF; border: none;']) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>