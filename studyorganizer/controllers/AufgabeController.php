<?php

namespace app\controllers;

use app\models\Aufgabe;
use app\models\AufgabeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AufgabeController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => \yii\filters\AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Nur eingeloggte User
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new AufgabeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($AufgabeID)
    {
        return $this->render('view', [
            'model' => $this->findModel($AufgabeID),
        ]);
    }

    public function actionCreate()
    {
        $model = new Aufgabe();
        $model->UserID = \Yii::$app->user->id; // Automatisch den aktuellen User setzen

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'AufgabeID' => $model->AufgabeID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($AufgabeID)
    {
        $model = $this->findModel($AufgabeID);

        // Verhindere Bearbeitung wenn Aufgabe erledigt ist
        if ($model->Finished && !$this->request->isPost) {
            \Yii::$app->session->setFlash('error', 'Erledigte Aufgaben können nicht mehr bearbeitet werden.');
            return $this->redirect(['view', 'AufgabeID' => $model->AufgabeID]);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'AufgabeID' => $model->AufgabeID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($AufgabeID)
    {
        $this->findModel($AufgabeID)->delete();

        return $this->redirect(['index']);
    }

    public function actionFinish($AufgabeID)
    {
        $model = $this->findModel($AufgabeID);
        $model->Finished = 1;
        if ($model->save()) {
            \Yii::$app->session->setFlash('success', 'Aufgabe als erledigt markiert.');
        }
        return $this->redirect(['view', 'AufgabeID' => $model->AufgabeID]);
    }

    protected function findModel($AufgabeID)
    {
        $conditions = ['AufgabeID' => $AufgabeID];

        // Normale User dürfen nur ihre eigenen Aufgaben sehen
        if (!\Yii::$app->user->identity->isAdmin()) {
            $conditions['UserID'] = \Yii::$app->user->id;
        }

        if (($model = Aufgabe::findOne($conditions)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}