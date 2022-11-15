<?php

namespace app\controllers;

use app\models\Payrolltaxes;
use app\models\PayrolltaxesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PayrolltaxesController implements the CRUD actions for Payrolltaxes model.
 */
class PayrolltaxesController extends Controller
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
     * Lists all Payrolltaxes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PayrolltaxesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payrolltaxes model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        ($concept_find = \app\models\Retentions::findOne($model->concept)) ? $concept = $concept_find->code : $concept = '';
        
        return $this->render('view', [
            'model' => $model,
            'concept' => $concept,
        ]);
    }

    /**
     * Creates a new Payrolltaxes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payrolltaxes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->retention - $retentions->validity_start";
        }

        return $this->render('create', [
            'model' => $model,
            'retentions' => $retention,
        ]);
    }

    /**
     * Updates an existing Payrolltaxes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->retention - $retentions->validity_start";
        }

        return $this->render('update', [
            'model' => $model,
            'retentions' => $retention,
        ]);
    }

    /**
     * Deletes an existing Payrolltaxes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payrolltaxes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Payrolltaxes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payrolltaxes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
