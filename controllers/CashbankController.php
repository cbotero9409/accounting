<?php

namespace app\controllers;

use app\models\Cashbank;
use app\models\CashbankSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CashbankController implements the CRUD actions for Cashbank model.
 */
class CashbankController extends Controller
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
     * Lists all Cashbank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CashbankSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cashbank model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->bank_account = $model->bankAccount->code . ' - ' . $model->bankAccount->account;
        $model->movement_type = \Yii::$app->params['cash_bank']['movement_type'][$model->movement_type];
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Cashbank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cashbank();
        
        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }
        
        $movement_type = \Yii::$app->params['cash_bank']['movement_type'];
        
        $model->date = date('Y-m-d');

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
            'mov_type' => $movement_type,
        ]);
    }

    /**
     * Updates an existing Cashbank model.
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
        
        $movement_type = \Yii::$app->params['cash_bank']['movement_type'];        
        

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'accounts' => $account,
            'mov_type' => $movement_type,
        ]);
    }

    /**
     * Deletes an existing Cashbank model.
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
     * Finds the Cashbank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cashbank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cashbank::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
