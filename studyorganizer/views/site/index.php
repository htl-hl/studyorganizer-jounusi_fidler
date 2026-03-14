<?php
// in folgendem Code wurden alle gehardcodeten Texte mit dem Übersetzer Yii::t ersetzt
// da es sehr viel aufwand gewesen wäre, führte diese Arbeit der Chattler durch
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'StudyOrganizer';
?>
<div class="site-index">

    <?php if (Yii::$app->user->isGuest): ?>
        <?php // Wenn nicht eingeloggt: Willkommensseite (von Jounusi) ?>
        <div class="jumbotron text-center bg-transparent mt-5 mb-5">
            <h1 class="display-4"><?= Yii::t('app', 'Welcome to StudyOrganizer!') ?></h1>
            <p class="lead"><?= Yii::t('app', 'Organize your tasks and subjects efficiently.') ?></p>
            <p><?= Html::a(Yii::t('app', 'Get started'), ['/site/login'], ['class' => 'btn btn-lg', 'style' => 'background-color: #1E90FF; color: white;']) ?></p>
        </div>
    <?php endif; ?>

    <div class="body-content">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if (Yii::$app->user->identity->isAdmin()): ?>
                <!-- Admin Dashboard -->
                <div class="alert alert-info mt-3">
                    <strong><?= Yii::t('app', 'Admin area') ?></strong> - <?= Yii::t('app', 'You have full access to all functions.') ?>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>' . Yii::t('app', 'Manage subjects') . '</h4><p>' . Yii::t('app', 'Create and edit subjects') . '</p>', ['fach/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>' . Yii::t('app', 'Manage teachers') . '</h4><p>' . Yii::t('app', 'Create and assign teachers') . '</p>', ['lehrer/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <?= Html::a('<h4>' . Yii::t('app', 'All tasks') . '</h4><p>' . Yii::t('app', 'Overview of all tasks') . '</p>', ['aufgabe/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                </div>
            <?php else: ?>
                <!-- User Dashboard -->
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <?= Html::a('<h4>' . Yii::t('app', 'My tasks') . '</h4><p>' . Yii::t('app', 'View and edit tasks') . '</p>', ['aufgabe/index'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <?= Html::a('<h4>' . Yii::t('app', 'New task') . '</h4><p>' . Yii::t('app', 'Create a new task') . '</p>', ['aufgabe/create'], ['class' => 'btn btn-outline-primary w-100 p-4 text-start']) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>