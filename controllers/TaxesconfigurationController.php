<?php

namespace app\controllers;

use app\models\Taxesconfiguration;
use app\models\TaxesconfigurationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaxesconfigurationController implements the CRUD actions for Taxesconfiguration model.
 */
class TaxesconfigurationController extends Controller
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
     * Lists all Taxesconfiguration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaxesconfigurationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taxesconfiguration model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        ($iva_find = \app\models\Retentions::findOne($model->iva)) ? $iva = $iva_find->code : $iva = '';
        ($retention_find = \app\models\Retentions::findOne($model->retention)) ? $retention = $retention_find->code : $retention = '';
        ($rete_ica_find = \app\models\Retentions::findOne($model->rete_ica)) ? $rete_ica = $rete_ica_find->code : $rete_ica = '';
        ($tax_cree_find = \app\models\Retentions::findOne($model->tax_cree)) ? $tax_cree = $tax_cree_find->code : $tax_cree = '';
        ($auto_retention_find = \app\models\Retentions::findOne($model->auto_retention)) ? $auto_retention = $auto_retention_find->code : $auto_retention = '';
        ($other_find = \app\models\Retentions::findOne($model->other)) ? $other = $other_find->code : $other = '';
        ($other_2_find = \app\models\Retentions::findOne($model->other_2)) ? $other_2 = $other_2_find->code : $other_2 = '';
        
        return $this->render('view', [
            'model' => $model,
            'iva' => $iva,
            'retention' => $retention,
            'rete_ica' => $rete_ica,
            'tax_cree' => $tax_cree,
            'auto_retention' => $auto_retention,
            'other' => $other,
            'other_2' => $other_2,
        ]);
    }

    /**
     * Creates a new Taxesconfiguration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Taxesconfiguration();

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
     * Updates an existing Taxesconfiguration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->retention - $retentions->validity_start";
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'retentions' => $retention,
        ]);
    }

    /**
     * Deletes an existing Taxesconfiguration model.
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
     * Finds the Taxesconfiguration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Taxesconfiguration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taxesconfiguration::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
