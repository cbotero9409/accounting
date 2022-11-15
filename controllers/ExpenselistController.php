<?php

namespace app\controllers;

use app\models\Expenselist;
use app\models\ExpenselistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExpenselistController implements the CRUD actions for Expenselist model.
 */
class ExpenselistController extends Controller
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
     * Lists all Expenselist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExpenselistSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Expenselist model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->fk_chart_account = $model->fkChartAccount->code . ' - ' . $model->fkChartAccount->account;
        $model->fk_cost_center = $model->fkCostCenter->code . ' - ' . $model->fkCostCenter->name;
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Expenselist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Expenselist();
        
        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }
        
        $center = array();
        $all_centers = \app\models\Costcenter::find()->all();
        foreach ($all_centers as $centers) {
            $center[$centers->id] = "$centers->code - $centers->name";
        }
        
//        $invoice = array();
//        $all_invoices = \app\models\Invoices::find()->all();
//        foreach ($all_invoices as $invoices) {
//            $invoice[$invoices->id] = $invoices->id;
//        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'accounts' => $account,
            'centers' => $center,
//            'invoices' => $invoice,
        ]);
    }

    /**
     * Updates an existing Expenselist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }
        
        $center = array();
        $all_centers = \app\models\Costcenter::find()->all();
        foreach ($all_centers as $centers) {
            $center[$centers->id] = "$centers->code - $centers->name";
        }

//        $invoice = array();
//        $all_invoices = \app\models\Invoices::find()->all();
//        foreach ($all_invoices as $invoices) {
//            $invoice[$invoices->id] = $invoices->id;
//        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'accounts' => $account,
            'centers' => $center,
//            'invoices' => $invoice,
        ]);
    }

    /**
     * Deletes an existing Expenselist model.
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
     * Finds the Expenselist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Expenselist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Expenselist::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
