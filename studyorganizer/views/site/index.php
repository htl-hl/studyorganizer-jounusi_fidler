<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'StudyOrganizer';
?>
<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <!-- Welcome Page für nicht eingeloggte User -->
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="text-center">
                <h1 class="display-3 fw-bold mb-4">Willkommen bei StudyOrganizer</h1>
                <p class="lead mb-4">Organisiere deine Aufgaben und behalte den Überblick über dein Studium</p>
                <?= Html::a('Get Started', ['site/login'], ['class' => 'btn btn-primary btn-lg px-5 py-3', 'style' => 'background-color: #1E90FF; border: none;']) ?>
            </div>
        </div>
    <?php else: ?>
        <!-- Dashboard für eingeloggte User -->
        <div class="mt-4">
            <h2>Willkommen, <?= Html::encode(Yii::$app->user->identity->Name) ?>!</h2>

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
        </div>
    <?php endif; ?>
</div>
