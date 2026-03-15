<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'en',
    'bootstrap' => ['log'],
    'on beforeRequest' => function ($event) { //bei jedem "Seitenwechsel" oder "Neuladung" passiert:
        $session = Yii::$app->session;
        $session->open();
        $lang = Yii::$app->request->get('lang');
        if ($lang && in_array($lang, ['de', 'en'])) { //speichert die Sprache wenns in der url ist
            $session->set('language', $lang);
            Yii::$app->language = $lang;
        } elseif ($session->has('language')) { // sonst aus Session laden
            Yii::$app->language = $session->get('language');
        }
    },
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UL-blZo8Cy0vHdxjEvLKomQZeBMJuHEX',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'i18n' => [ // der Block macht Übersetzungen, genauso wie Yii::t
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // Ordner: studyorganizer/messages/ de oder eng
                    'sourceLanguage' => 'en', // Standard, das passt so
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
        'on beforeAction' => function ($event) {
            // Prüfe, ob der User Gast ist ODER kein Admin ist
            if (Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()) {
                throw new \yii\web\ForbiddenHttpException('Zugriff verweigert.');
            }
        },
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
