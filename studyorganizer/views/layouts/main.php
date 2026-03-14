<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::getAlias('@web/logo.png')]);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <style>
        #main-nav .nav-link, #main-nav .navbar-brand, #main-nav .btn-link { color: white !important; }
        #main-nav .dropdown-menu .dropdown-item { color: #333; }
        #main-nav .dropdown-menu .dropdown-item:hover { background-color: #f0f0f0; }

        body {
            background-image: url('<?= Yii::getAlias('@web') ?>/logo.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: 40%;
            opacity: 1;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?= Yii::getAlias('@web') ?>/logo.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 40%;
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
        }
    </style>

    <header id="header">
        <?php
        NavBar::begin([
                'brandLabel' => '<img src="' . Yii::getAlias('@web') . '/logo.png" alt="' . Yii::$app->name . '" style="height: 40px;">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top', 'style' => 'background-color: #1E90FF;', 'id' => 'main-nav']
        ]);

        // Linke Navigationsitems
        echo Nav::widget([
                'options' => ['class' => 'navbar-nav me-auto'],
                'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                ],
        ]);

        // Rechte Seite: Profil-Dropdown oder Login
        if (!Yii::$app->user->isGuest) {
            $userName = Yii::$app->user->identity->Name;
            // Profilbild Platzhalter: Kreis mit Initiale des Usernamens
            $initial = strtoupper(substr($userName, 0, 1));
            ?>
            <div class="dropdown profile-dropdown ms-auto" data-bs-auto-close="outside"> <?php // data-bs-auto-close="outside" = Dropdown schließt sich nur beim Klick außerhalb ?>
                <?= Html::button(
                        $userName,
                        [
                                'class' => 'nav-link dropdown-toggle',
                                'data-bs-toggle' => 'dropdown',
                                'aria-expanded' => 'false',
                                'style' => 'background:none; border:none;'
                        ]
                ) ?>
                <ul class="dropdown-menu dropdown-menu-end">
                    <?php // Sprache-Slider: England links, Slider Mitte, Deutschland rechts ?>
                    <li>
                        <div class="dropdown-item d-flex align-items-center gap-2" onclick="event.stopPropagation();"> <?php // onclick stopPropagation = Klick schließt Dropdown nicht ?>
                            <img src="https://flagcdn.com/w20/gb.png" alt="EN" style="height:16px;" id="flagEN"> <?php // England Flagge von flagcdn.com ?>
                            <div class="form-check form-switch d-inline-block mb-0">
                                <input class="form-check-input" type="checkbox" id="languageSwitch" <?= Yii::$app->language == 'de' ? 'checked' : '' ?>> <?php //checked speichert den sliderstatus ?>
                            </div>
                            <img src="https://flagcdn.com/w20/de.png" alt="DE" style="height:16px;" id="flagDE"> <?php // Deutschland Flagge von flagcdn.com ?>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?= Html::submitButton('&#128682; Logout', ['class' => 'dropdown-item border-0 bg-transparent w-100 text-start']) ?>
                        <?= Html::endForm() ?>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                           data-bs-target="#deleteAccountModal">&#128465; <?= Yii::t('app', 'Delete account') ?></a></li>
                </ul>
            </div>
            <?php
        } else {
            // Nicht eingeloggt: Login rechts
            echo Nav::widget([
                    'options' => ['class' => 'navbar-nav ms-auto'],
                    'items' => [
                            ['label' => 'Login', 'url' => ['/site/login']],
                    ],
            ]);
        }

        NavBar::end();
        ?>
    </header>

    <?php if (!Yii::$app->user->isGuest): ?>
        <!-- Delete Account Modal -->
        <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">&#9888; <?= Yii::t('app', 'Delete account') ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this account? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Cancel</button>
                        <?= Html::beginForm(['/site/delete-account'], 'post') ?>
                        <?= Html::submitButton('Yes, Delete', ['class' => 'btn btn-danger']) ?>
                        <?= Html::endForm() ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <?php // tex-muted = schwarz  |  text-white = weiß ?>
    <footer id="footer" class="mt-auto py-4 text-white" style="background-color: #1E90FF;">
        <?php // Link-Farbe im Footer weiß machen ?>
        <style>
            #footer a { color: white; }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">StudyOrganizer</h5>
                    <p class="text-white small"><?= Yii::t('app', 'Your personal task and learning planner.') ?></p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold"><?= Yii::t('app', 'Contact') ?></h6>
                    <?php // Die Symbole habe ich ergoogelt, das war nicht der Chattler https://www.compart.com/de/unicode/U+2709 ?>
                    <p class="text-white small mb-1">&#128231; info@studyorganizer.at</p>
                    <p class="text-white small mb-1">&#128222; +43 123 456 789</p>
                </div>
                <div class="col-md-4 mb-3 text-md-end">
                    <p class="text-white small">&copy; StudyOrganizer <?= date('Y') ?></p>
                    <p class="text-white small"><?= Yii::powered() ?></p>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->registerJs(" // aus ITP Projekt kopiert
        function updateLangVisual(isDE) {
            var flagDE = document.getElementById('flagDE');
            var flagEN = document.getElementById('flagEN');
            if (!flagDE || !flagEN) return;
            if (isDE) {
                flagDE.classList.add('active');
                flagEN.classList.remove('active');
            } else {
                flagDE.classList.remove('active');
                flagEN.classList.add('active');
            }
        }

        var langSwitch = document.getElementById('languageSwitch');
        if (langSwitch) {
            updateLangVisual(langSwitch.checked);
            langSwitch.addEventListener('change', function(e) {
                e.stopPropagation();
                var lang = this.checked ? 'de' : 'en';
                updateLangVisual(this.checked);
                 var url = window.location.href.split('?')[0] + '?langChanged=1&lang=' + lang; // Sprache und langChanged direkt in URL
                window.location.href = url; 
            });
        }

        // Nach Reload: Dropdown wieder öffnen wenn Sprache gerade gewechselt wurde
        if (window.location.search.indexOf('langChanged=1') !== -1) {
            var toggleBtn = document.querySelector('.profile-dropdown .dropdown-toggle');
            if (toggleBtn) {
                new bootstrap.Dropdown(toggleBtn).show();
            }
        }
    "); ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>