<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'delete-account','set-language'],
                'rules' => [
                    [
                        'actions' => ['logout', 'delete-account', 'set-language'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'delete-account' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new \app\models\User();
        $model->scenario = 'signup';

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Registrierung erfolgreich! Du kannst dich jetzt einloggen.');
            return $this->redirect(['site/login']);
        }

        return $this->redirect(['site/login']);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionDeleteAccount()
    {
        $user = \app\models\User::findOne(Yii::$app->user->id);
        if ($user) {
            Yii::$app->user->logout();
            $user->delete();
            Yii::$app->session->setFlash('success', 'Dein Konto wurde erfolgreich gelöscht.');
        }
        return $this->redirect(['site/login']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionSetLanguage($lang)
    {
        if (in_array($lang, ['de', 'en'])) { // wenn man afghanisch oder sowas wählt gehts nicht
            Yii::$app->session->set('language', $lang); // gewählte Sprache in Session speichern
            Yii::$app->language = $lang; // Sprache sofort für diesen Request setzen
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl); // zurück zur vorherigen Seite
    }
}