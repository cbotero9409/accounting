<?php

namespace app\controllers;

use app\models\Retentions;
use app\models\RetentionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RetentionsController implements the CRUD actions for Retentions model.
 */
class RetentionsController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
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
     * Lists all Retentions models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RetentionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Retentions model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        $model->min_base_value = number_format(floatval($model->min_base_value), 2, ",", ".");
        if ($model->calculation_type != 1) {
            $model->value = number_format(floatval($model->value), 2, ",", ".");
        } else {
            $model->value = "$model->value%";
        }
        $model->fk_parent_retention = $model->fkParentRetention->code;
        $model->validity_start = date('d-m-Y', strtotime($model->validity_start));
        $model->calculation_type = \Yii::$app->params['retentions']['calculation_type'][$model->calculation_type];
        if ($model->auto_calculation == 1) {
            $model->auto_calculation = 'Activado';
        } else {
            $model->auto_calculation = 'Desactivado';
        }
        $model->movement_type = \Yii::$app->params['retentions']['movement_type'][$model->movement_type];
        $model->bill_to_pay = $model->billToPay->code . ' - ' . $model->billToPay->account;
        $model->how_affects = \Yii::$app->params['retentions']['how_affects'][$model->how_affects];
        $model->payment_date_table = \Yii::$app->params['retentions']['payment_table'][$model->payment_date_table];
        $model->third_party_alias = \Yii::$app->params['retentions']['third_id'][$model->third_party_alias];
        if (isset($model->expense_account)) {
            $model->expense_account = $model->expenseAccount->code . ' - ' . $model->expenseAccount->account;
        } else {
            $model->expense_account = '';
        }
        if (isset($model->cost_center)) {
            $model->cost_center = $model->costCenter->code . ' - ' . $model->costCenter->name;
        } else {
            $model->cost_center = '';
        }

        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new Retentions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Retentions();

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
        }

        $model->validity_start = date('Y-m-d', strtotime(date('Y-01-01')));
        $cal_type = [1 => 'Porcentaje', 2 => 'Valor', 3 => 'Valor por Cantidad'];
        $movement_type = [1 => 'Generar una cuenta por cobrar', 2 => 'Generar una cuenta por pagar', 3 => 'Llevar al ingreso', 4 => 'Llevar al gasto'];

        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $payment_table = [1 => 'CESANTIAS', 2 => 'EPS, ARP, PENSION', 3 => 'INTCESANTIAS', 4 => 'IVA', 5 => 'PAGO RENTAS', 6 => 'PRIMAS', 7 => 'RETENCION', 8 => 'VACACIONES'];
        $third_id = [1 => 'ADMINIMP', 2 => 'ADMMPAL', 3 => 'ARP', 4 => 'CCF', 5 => 'CESANTIAS', 6 => 'EPS', 7 => 'ICBF'];
        $how_affects = [1 => 'Resta al total a pagar ', 2 => 'No suma ni resta al total', 3 => 'Suma al total a pagar'];

        $cost_center = array();
        $all_cost_centers = \app\models\Costcenter::find()->all();
        foreach ($all_cost_centers as $costs_centers) {
            $cost_center[$costs_centers->id] = "$costs_centers->code - $costs_centers->name";
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'retentions' => $retention,
                    'cal_type' => $cal_type,
                    'mov_type' => $movement_type,
                    'accounts' => $account,
                    'payment_table' => $payment_table,
                    'third_id' => $third_id,
                    'cost_center' => $cost_center,
                    'how_affects' => $how_affects,
        ]);
    }

    /**
     * Updates an existing Retentions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
        }

        $cal_type = [1 => 'Porcentaje', 2 => 'Valor', 3 => 'Valor por Cantidad'];
        $movement_type = [1 => 'Generar una cuenta por cobrar', 2 => 'Generar una cuenta por pagar', 3 => 'Llevar al ingreso', 4 => 'Llevar al gasto'];

        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $payment_table = [1 => 'CESANTIAS', 2 => 'EPS, ARP, PENSION', 3 => 'INTCESANTIAS', 4 => 'IVA', 5 => 'PAGO RENTAS', 6 => 'PRIMAS', 7 => 'RETENCION', 8 => 'VACACIONES'];
        $third_id = [1 => 'ADMINIMP', 2 => 'ADMMPAL', 3 => 'ARP', 4 => 'CCF', 5 => 'CESANTIAS', 6 => 'EPS', 7 => 'ICBF'];
        $how_affects = [1 => 'Resta al total a pagar ', 2 => 'No suma ni resta al total', 3 => 'Suma al total a pagar'];

        $cost_center = array();
        $all_cost_centers = \app\models\Costcenter::find()->all();
        foreach ($all_cost_centers as $costs_centers) {
            $cost_center[$costs_centers->id] = "$costs_centers->code - $costs_centers->name";
        }


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'retentions' => $retention,
                    'cal_type' => $cal_type,
                    'mov_type' => $movement_type,
                    'accounts' => $account,
                    'payment_table' => $payment_table,
                    'third_id' => $third_id,
                    'cost_center' => $cost_center,
                    'how_affects' => $how_affects,
        ]);
    }

    /**
     * Deletes an existing Retentions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Retentions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Retentions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Retentions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
