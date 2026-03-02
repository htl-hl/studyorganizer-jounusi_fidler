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
    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
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

        <header id="header">
            <?php
            NavBar::begin([
                    'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => ['class' => 'navbar-expand-md navbar-dark fixed-top', 'style' => 'background-color: #1E90FF;']
            ]);
            echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                            ['label' => 'Home', 'url' => ['/site/index']],
                            ['label' => 'About', 'url' => ['/site/about']],
                            ['label' => 'Contact', 'url' => ['/site/contact']],
                            Yii::$app->user->isGuest
                                    ? ['label' => 'Login', 'url' => ['/site/login']]
                                    : '<li class="nav-item">'
                                    . Html::beginForm(['/site/logout'])
                                    . Html::submitButton(
                                            'Logout (' . Yii::$app->user->identity->Name . ')',
                                            ['class' => 'nav-link btn btn-link logout']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                    ]
            ]);
            NavBar::end();
            ?>
        </header>

        <main id="main" class="flex-shrink-0" role="main">
            <div class="container">
                <?php if (!empty($this->params['breadcrumbs'])): ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <?php // Farbe von Farbtabelle ?>
        <footer id="footer" class="mt-auto py-4 text-white" style="background-color: #1E90FF;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5 class="fw-bold">StudyOrganizer</h5>
                        <p class="text-muted small">Dein persönlicher Aufgaben- und Lernplaner.</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h6 class="fw-bold">Kontakt</h6>
                        <?php // Die Symbole habe ich ergoogelt, das war nicht der Chattler https://www.compart.com/de/unicode/U+2709 ?>
                        <p class="text-muted small mb-1">&#128231; info@studyorganizer.at</p>
                        <p class="text-muted small mb-1">&#128222; +43 123 456 789</p>
                    </div>
                    <div class="col-md-4 mb-3 text-md-end">
                        <p class="text-muted small">&copy; StudyOrganizer <?= date('Y') ?></p>
                        <p class="text-muted small"><?= Yii::powered() ?></p>
                    </div>
                </div>
            </div>
        </footer>

        <?php $this->endBody() ?>
        </body>
        </html>
    <?php $this->endPage() ?>