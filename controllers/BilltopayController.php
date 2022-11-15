<?php

namespace app\controllers;

use app\models\Billtopay;
use app\models\BilltopaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BilltopayController implements the CRUD actions for Billtopay model.
 */
class BilltopayController extends Controller
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
     * Lists all Billtopay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BilltopaySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Billtopay model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->third_party = $model->thirdParty->code . ' - ' . $model->thirdParty->account;
        $model->account = $model->account0->code . ' - ' . $model->account0->account;
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Billtopay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Billtopay();
        
        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }
        
        $model->date_to_pay = date('Y-m-d', strtotime("+1 month"));        

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
        ]);
    }

    /**
     * Updates an existing Billtopay model.
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
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'accounts' => $account,
        ]);
    }

    /**
     * Deletes an existing Billtopay model.
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
     * Finds the Billtopay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Billtopay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Billtopay::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
