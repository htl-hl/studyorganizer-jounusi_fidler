<?php

namespace app\controllers;

use app\models\Aufgabe;
use app\models\AufgabeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AufgabeController implements the CRUD actions for Aufgabe model.
 */
class AufgabeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Aufgabe models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AufgabeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aufgabe model.
     * @param int $AufgabeID Aufgabe ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($AufgabeID)
    {
        return $this->render('view', [
            'model' => $this->findModel($AufgabeID),
        ]);
    }

    /**
     * Creates a new Aufgabe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Aufgabe();

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

    /**
     * Updates an existing Aufgabe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $AufgabeID Aufgabe ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($AufgabeID)
    {
        $model = $this->findModel($AufgabeID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'AufgabeID' => $model->AufgabeID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Aufgabe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $AufgabeID Aufgabe ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($AufgabeID)
    {
        $this->findModel($AufgabeID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aufgabe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $AufgabeID Aufgabe ID
     * @return Aufgabe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($AufgabeID)
    {
        if (($model = Aufgabe::findOne(['AufgabeID' => $AufgabeID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
