<?php

namespace app\controllers;

use app\models\FachLehrer;
use app\models\FachLehrerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FachLehrerController implements the CRUD actions for FachLehrer model.
 */
class FachLehrerController extends Controller
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
     * Lists all FachLehrer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FachLehrerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FachLehrer model.
     * @param int $FachID Fach ID
     * @param int $LehrerID Lehrer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($FachID, $LehrerID)
    {
        return $this->render('view', [
            'model' => $this->findModel($FachID, $LehrerID),
        ]);
    }

    /**
     * Creates a new FachLehrer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FachLehrer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FachLehrer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $FachID Fach ID
     * @param int $LehrerID Lehrer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($FachID, $LehrerID)
    {
        $model = $this->findModel($FachID, $LehrerID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'FachID' => $model->FachID, 'LehrerID' => $model->LehrerID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FachLehrer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $FachID Fach ID
     * @param int $LehrerID Lehrer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($FachID, $LehrerID)
    {
        $this->findModel($FachID, $LehrerID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FachLehrer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $FachID Fach ID
     * @param int $LehrerID Lehrer ID
     * @return FachLehrer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($FachID, $LehrerID)
    {
        if (($model = FachLehrer::findOne(['FachID' => $FachID, 'LehrerID' => $LehrerID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
