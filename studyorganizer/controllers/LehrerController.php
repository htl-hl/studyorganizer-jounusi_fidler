<?php

namespace app\controllers;

use app\models\Lehrer;
use app\models\LehrerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LehrerController implements the CRUD actions for Lehrer model.
 */
class LehrerController extends Controller
{
    /**
     * @inheritDoc
     */
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
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return \Yii::$app->user->identity->isAdmin(); // Nur Admins dürfen Lehrer verwalten
                            }
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'toggle-active' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Lehrer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LehrerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lehrer model.
     * @param int $LehrerID Lehrer ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($LehrerID)
    {
        return $this->render('view', [
            'model' => $this->findModel($LehrerID),
        ]);
    }

    /**
     * Creates a new Lehrer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lehrer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'LehrerID' => $model->LehrerID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Lehrer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $LehrerID Lehrer ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($LehrerID)
    {
        $model = $this->findModel($LehrerID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'LehrerID' => $model->LehrerID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lehrer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $LehrerID Lehrer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($LehrerID)
    {
        // Lehrer können nicht gelöscht werden, nur deaktiviert
        \Yii::$app->session->setFlash('error', 'Lehrer können nicht gelöscht werden. Bitte setze sie auf Inaktiv.');
        return $this->redirect(['index']);
    }

    /**
     * Toggles the IsActive status of a Lehrer
     * @param int $LehrerID Lehrer ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionToggleActive($LehrerID)
    {
        $model = $this->findModel($LehrerID);
        $model->IsActive = !$model->IsActive;

        if ($model->save()) {
            $status = $model->IsActive ? 'aktiviert' : 'deaktiviert';
            \Yii::$app->session->setFlash('success', "Lehrer wurde erfolgreich {$status}.");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lehrer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $LehrerID Lehrer ID
     * @return Lehrer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($LehrerID)
    {
        if (($model = Lehrer::findOne(['LehrerID' => $LehrerID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
