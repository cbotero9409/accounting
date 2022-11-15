<?php

namespace app\controllers;

use app\models\Billofsale;
use app\models\BillofsaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BillofsaleController implements the CRUD actions for Billofsale model.
 */
class BillofsaleController extends Controller {

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
     * Lists all Billofsale models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BillofsaleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Billofsale model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $files_model = \app\models\Billsattachedfiles::findAll(['fk_bill_of_sale' => $id]);

        $model->fk_doc_type = $model->fkDocType->code . ' - ' . $model->fkDocType->name;
        $model->date = date('d-m-Y', strtotime($model->date));
        if (isset($model->class)) {
            $model->class = \Yii::$app->params['invoices']['class'][$model->class];
        }
        if (isset($model->fk_municipality)) {
            $model->fk_municipality = $model->fkMunicipality->municipality;
        }
        $model->cost_center = $model->costCenter->code . ' - ' . $model->costCenter->name;
        $model->client = $model->client0->code . ' - ' . $model->client0->account;
        $model->seller = $model->seller0->code . ' - ' . $model->seller0->account;

        $all_incomes = \app\models\Incomelist::findAll(['fk_bill' => $id]);
        $all_taxes = \app\models\Taxesliquidation::findAll(['fk_bill' => $id]);

        $i = 0;
        $cash = FALSE;
        $cash_bank = FALSE;
        $cash_bill = FALSE;
        $bank_model = '';
        $bill_model = '';
        if (!is_null($model->cash)) {
            if ($model->cash !== 0) {
                $i++;
                $cash = TRUE;
            }
        }
        if (!is_null($model->cash_payment_bank)) {
            if ($model->cash_payment_bank !== 0) {
                $i++;
                $cash_bank = TRUE;
                $bank_model = \app\models\Cashbank::findOne(['fk_bill' => $id]);
                if (isset($bank_model->movement_type)) {
                    $bank_model->movement_type = \Yii::$app->params['cash_bank']['movement_type'][$bank_model->movement_type];
                }
                if (isset($bank_model->date)) {
                    $bank_model->date = date('d-m-Y', strtotime($bank_model->date));
                }
            }
        }
        if (!is_null($model->bill_to_pay)) {
            if ($model->bill_to_pay !== 0) {
                $i++;
                $cash_bill = TRUE;
                $bill_model = \app\models\Billtopay::findOne(['fk_bill' => $id]);
                if (isset($bill_model->date_to_pay)) {
                    $bill_model->date_to_pay = date('d-m-Y', strtotime($bill_model->date_to_pay));
                }
            }
        }
        if ($i == 1) {
            $col = 12;
        } elseif ($i == 2) {
            $col = 6;
        } elseif ($i == 3) {
            $col = 4;
        }

        if (isset($model->type_of_operation)) {
            $model->type_of_operation = \Yii::$app->params['bills_of_sale']['type_op'][$model->type_of_operation];
        }



        return $this->render('view', [
                    'model' => $model,
                    'incomes' => $all_incomes,
                    'taxes' => $all_taxes,
                    'cash' => $cash,
                    'cash_bank' => $cash_bank,
                    'cash_bill' => $cash_bill,
                    'column' => $col,
                    'bank_model' => $bank_model,
                    'bill_model' => $bill_model,
                    'files_model' => $files_model,
        ]);
    }

    /**
     * Creates a new Billofsale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Billofsale();
        $bank_model = new \app\models\Cashbank();
        $bills_model = new \app\models\Billtopay();
        $uploads_model = new \app\models\Billsattachedfiles();

        $doc_type = array();
        $all_doc_types = \app\models\Documenttype::find()->all();
        foreach ($all_doc_types as $doc_types) {
            $doc_type[$doc_types->id] = "$doc_types->code - $doc_types->name";
        }

        $model->date = date('Y-m-d');
        $classes = \Yii::$app->params['bills_of_sale']['class'];

        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
        foreach ($depts as $dept) {
            $option_depts .= "<option value='$dept->id'>$dept->department</option>";
        }

        $cost_center = array();
        $all_cost_centers = \app\models\Costcenter::find()->all();
        foreach ($all_cost_centers as $costs_centers) {
            $cost_center[$costs_centers->id] = "$costs_centers->code - $costs_centers->name";
        }

        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
        }

        $movement_type = \Yii::$app->params['cash_bank']['movement_type'];
        $type_op = \Yii::$app->params['bills_of_sale']['type_op'];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {
                    $last_bill = Billofsale::find()->orderBy(['id' => SORT_DESC])->one();

                    if ($model->cash_payment_bank !== '' && $model->cash_payment_bank !== 0) {
                        if ($bank_model->load($this->request->post())) {
                            $bank_model->fk_bill = $last_bill->id;
                            $bank_model->save();
                        }
                    }

                    if ($model->bill_to_pay !== '' && $model->bill_to_pay !== 0) {
                        if ($bills_model->load($this->request->post())) {
                            $bills_model->fk_bill = $last_bill->id;
                            $bills_model->save();
                        }
                    }

                    $incomes_accounts = json_decode(filter_input(INPUT_POST, 'accounts_hidden'), true);
                    $incomes_concepts = json_decode(filter_input(INPUT_POST, 'concepts_hidden'), true);
                    $incomes_prices = json_decode(filter_input(INPUT_POST, 'prices_hidden'), true);
                    $incomes_centers = json_decode(filter_input(INPUT_POST, 'centers_hidden'), true);

                    for ($i = 0; $i < count($incomes_accounts); $i++) {
                        $incomes_model = new \app\models\Incomelist();
                        $incomes_model->fk_chart_account = $incomes_accounts[$i];
                        $incomes_model->concept = $incomes_concepts[$i];
                        $incomes_model->price = $incomes_prices[$i];
                        $incomes_model->fk_cost_center = $incomes_centers[$i];
                        $incomes_model->fk_bill = $last_bill->id;
                        if (!$incomes_model->save()) {
                            print_r($incomes_model->getErrors());
                            die();
                        }
                    }

                    $taxes_concepts = json_decode(filter_input(INPUT_POST, 'tax_concept_hidden'), true);
                    $taxes_base_values = json_decode(filter_input(INPUT_POST, 'base_value_hidden'), true);
                    $taxes_observations = json_decode(filter_input(INPUT_POST, 'observation_hidden'), true);
                    $taxes_prices = json_decode(filter_input(INPUT_POST, 'tax_price_hidden'), true);
                    $taxes_accounts = json_decode(filter_input(INPUT_POST, 'account_affects_hidden'), true);
                    $taxes_thirds = json_decode(filter_input(INPUT_POST, 'thirds_hidden'), true);
                    $taxes_cc = json_decode(filter_input(INPUT_POST, 'cc_hidden'), true);
                    $taxes_dates = json_decode(filter_input(INPUT_POST, 'date_hidden'), true);

                    for ($j = 0; $j < count($taxes_concepts); $j++) {
                        $taxes_model = new \app\models\Taxesliquidation();
                        $taxes_model->concept = $taxes_concepts[$j];
                        $taxes_model->base_value = $taxes_base_values[$j];
                        $taxes_model->observation = $taxes_observations[$j];
                        $taxes_model->price = $taxes_prices[$j];
                        $taxes_model->account_to_affect = $taxes_accounts[$j];
                        $taxes_model->third_party = $taxes_thirds[$j];
                        $taxes_model->cc_active = $taxes_cc[$j];
                        $taxes_model->payment_date = $taxes_dates[$j];
                        $taxes_model->fk_bill = $last_bill->id;
                        $taxes_model->save();
                    }

                    if ($uploads_model->load($this->request->post())) {
                        $uploads_model->uploaded_files = UploadedFile::getInstances($uploads_model, 'uploaded_files');
                        if (!empty($uploads_model->uploaded_files)) {
                            $path = "uploads/bills_of_sale/";
                            foreach ($uploads_model->uploaded_files as $file) {
                                $file_name = str_replace([' '], '_', $file->baseName);
                                if ($file->saveAs("$path/$last_bill->id-$file_name.$file->extension")) {
                                    $attached_files_model = new \app\models\Billsattachedfiles();
                                    $attached_files_model->file = "$last_bill->id-$file_name.$file->extension";
                                    $attached_files_model->fk_bill_of_sale = $last_bill->id;
                                    $attached_files_model->save();
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    print_r($model->getErrors());
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'classes' => $classes,
                    'munic' => array(),
                    'depts' => $option_depts,
                    'cost_center' => $cost_center,
                    'accounts' => $account,
                    'retentions' => $retention,
                    'bank_model' => $bank_model,
                    'mov_type' => $movement_type,
                    'bills_model' => $bills_model,
                    'type_operation' => $type_op,
                    'uploads_model' => $uploads_model,
                    'files_array' => array(),
        ]);
    }

    /**
     * Updates an existing Billofsale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $uploads_model = new \app\models\Billsattachedfiles();

        $bank_model = \app\models\Cashbank::find()->where(['fk_bill' => $id])->one();
        if (!isset($bank_model->id)) {
            $bank_model = new \app\models\Cashbank();
        }
        $bills_model = \app\models\Billtopay::find()->where(['fk_bill' => $id])->one();
        if (!isset($bills_model->id)) {
            $bills_model = new \app\models\Billtopay();
        }
        $all_uploads_models = \app\models\Billsattachedfiles::findall(['fk_bill_of_sale' => $id]);
        $files_array = array();
        $files_name = array();
        foreach ($all_uploads_models as $uploaded) {
            $files_array[] = "../uploads/bills_of_sale/$uploaded->file";
            $files_name[] = ['caption' => $uploaded->file];
        }

        $doc_type = array();
        $all_doc_types = \app\models\Documenttype::find()->all();
        foreach ($all_doc_types as $doc_types) {
            $doc_type[$doc_types->id] = "$doc_types->code - $doc_types->name";
        }

        $classes = \Yii::$app->params['bills_of_sale']['class'];

        $option_depts = '';
        $depts = \app\models\Departments::find()->all();

        if (isset($model->fk_municipality)) {
            $municipalities_select = \app\models\Municipality::find()->select(['fk_department'])->where(['id' => $model->fk_municipality])->one();
            foreach ($depts as $dept) {
                $option_depts .= "<option value='$dept->id'";
                if ($dept->id == $municipalities_select->fk_department) {
                    $option_depts .= "selected";
                }
                $option_depts .= ">$dept->department</option>";
            }
            $municipalities = \app\models\Municipality::find()->where(['fk_department' => $municipalities_select->fk_department])->all();
            foreach ($municipalities as $municipality) {
                $option_muni[$municipality->id] = $municipality->municipality;
            }
        } else {
            foreach ($depts as $dept) {
                $option_depts .= "<option value='$dept->id'>$dept->department</option>";
            }
            $option_muni = array();
        }

        $cost_center = array();
        $all_cost_centers = \app\models\Costcenter::find()->all();
        foreach ($all_cost_centers as $costs_centers) {
            $cost_center[$costs_centers->id] = "$costs_centers->code - $costs_centers->name";
        }

        $account = array();
        $all_accounts = \app\models\Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $retention = array();
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
        }

        $movement_type = \Yii::$app->params['cash_bank']['movement_type'];
        $type_op = \Yii::$app->params['bills_of_sale']['type_op'];

        $all_income_list = \app\models\Incomelist::findAll(['fk_bill' => $id]);
        $all_taxes_list = \app\models\Taxesliquidation::findAll(['fk_bill' => $id]);

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->save()) {

                    if ($model->cash_payment_bank !== '' && $model->cash_payment_bank !== 0) {
                        if ($bank_model->load($this->request->post())) {
                            $bank_model->fk_bill = $id;
                            $bank_model->save();
                        }
                    } else {
                        $bank_model->delete();
                    }

                    if ($model->bill_to_pay !== '' && $model->bill_to_pay !== 0) {
                        if ($bills_model->load($this->request->post())) {
                            $bills_model->fk_bill = $id;
                            $bills_model->save();
                        }
                    } else {
                        $bills_model->delete();
                    }

                    $incomes_accounts = json_decode(filter_input(INPUT_POST, 'accounts_hidden'), true);
                    $incomes_concepts = json_decode(filter_input(INPUT_POST, 'concepts_hidden'), true);
                    $incomes_prices = json_decode(filter_input(INPUT_POST, 'prices_hidden'), true);
                    $incomes_centers = json_decode(filter_input(INPUT_POST, 'centers_hidden'), true);
                    \app\models\Incomelist::deleteAll(['fk_bill' => $id]);

                    for ($i = 0; $i < count($incomes_accounts); $i++) {
                        $incomes_model = new \app\models\Incomelist();
                        $incomes_model->fk_chart_account = $incomes_accounts[$i];
                        $incomes_model->concept = $incomes_concepts[$i];
                        $incomes_model->price = $incomes_prices[$i];
                        $incomes_model->fk_cost_center = $incomes_centers[$i];
                        $incomes_model->fk_bill = $id;
                        $incomes_model->save();
                    }

                    $taxes_concepts = json_decode(filter_input(INPUT_POST, 'tax_concept_hidden'), true);
                    $taxes_base_values = json_decode(filter_input(INPUT_POST, 'base_value_hidden'), true);
                    $taxes_observations = json_decode(filter_input(INPUT_POST, 'observation_hidden'), true);
                    $taxes_prices = json_decode(filter_input(INPUT_POST, 'tax_price_hidden'), true);
                    $taxes_accounts = json_decode(filter_input(INPUT_POST, 'account_affects_hidden'), true);
                    $taxes_thirds = json_decode(filter_input(INPUT_POST, 'thirds_hidden'), true);
                    $taxes_cc = json_decode(filter_input(INPUT_POST, 'cc_hidden'), true);
                    $taxes_dates = json_decode(filter_input(INPUT_POST, 'date_hidden'), true);
                    \app\models\Taxesliquidation::deleteAll(['fk_bill' => $id]);

                    for ($j = 0; $j < count($taxes_concepts); $j++) {
                        $taxes_model = new \app\models\Taxesliquidation();
                        $taxes_model->concept = $taxes_concepts[$j];
                        $taxes_model->base_value = $taxes_base_values[$j];
                        $taxes_model->observation = $taxes_observations[$j];
                        $taxes_model->price = $taxes_prices[$j];
                        $taxes_model->account_to_affect = $taxes_accounts[$j];
                        $taxes_model->third_party = $taxes_thirds[$j];
                        $taxes_model->cc_active = $taxes_cc[$j];
                        $taxes_model->payment_date = $taxes_dates[$j];
                        $taxes_model->fk_bill = $id;
                        $taxes_model->save();
                    }

                    if ($uploads_model->load($this->request->post())) {
                        $files_models = \app\models\Billsattachedfiles::findAll(['fk_bill_of_sale' => $id]);
                        if (!empty($files_models)) {
                            foreach ($files_models as $file_up) {
                                $file_path = 'uploads/bills_of_sale/' . $file_up->file;
                                if (is_file($file_path)) {
                                    unlink($file_path);
                                }
                            }
                        }
                        \app\models\Billsattachedfiles::deleteAll(['fk_bill_of_sale' => $id]);

                        $uploads_model->uploaded_files = UploadedFile::getInstances($uploads_model, 'uploaded_files');
                        if (!empty($uploads_model->uploaded_files)) {
                            $path = "uploads/bills_of_sale/";
                            foreach ($uploads_model->uploaded_files as $file) {
                                $file_name = str_replace([' '], '_', $file->baseName);
                                if ($file->saveAs("$path/$id-$file_name.$file->extension")) {
                                    $attached_files_model = new \app\models\Billsattachedfiles();
                                    $attached_files_model->file = "$id-$file_name.$file->extension";
                                    $attached_files_model->fk_bill_of_sale = $id;
                                    if($attached_files_model->save()){
                                        
                                    } else {
                                        print_r($attached_files_model->getErrors());
                                        die();
                                    }
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'classes' => $classes,
                    'munic' => $option_muni,
                    'depts' => $option_depts,
                    'cost_center' => $cost_center,
                    'accounts' => $account,
                    'retentions' => $retention,
                    'bank_model' => $bank_model,
                    'mov_type' => $movement_type,
                    'bills_model' => $bills_model,
                    'type_operation' => $type_op,
                    'all_income_list' => $all_income_list,
                    'all_taxes_list' => $all_taxes_list,
                    'files_array' => $files_array,
                    'uploads_model' => $uploads_model,
                    'files_name' => $files_name
        ]);
    }

    /**
     * Deletes an existing Billofsale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $bills = \app\models\Billtopay::deleteAll(['fk_bill' => $id]);
        $bank = \app\models\Cashbank::deleteAll(['fk_bill' => $id]);
        $incomes = \app\models\Incomelist::deleteAll(['fk_bill' => $id]);
        $taxes = \app\models\Taxesliquidation::deleteAll(['fk_bill' => $id]);

        $files_models = \app\models\Billsattachedfiles::findAll(['fk_bill_of_sale' => $id]);
        if (!empty($files_models)) {
            foreach ($files_models as $file_up) {
                $file_path = 'uploads/bills_of_sale/' . $file_up->file;
                if (is_file($file_path)) {
                    unlink($file_path);
                }
            }
        }
        $files = \app\models\Billsattachedfiles::deleteAll(['fk_bill_of_sale' => $id]);

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Billofsale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Billofsale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Billofsale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTypedocument($id) {
        $type = \app\models\Documenttype::findOne($id);
        $max = Billofsale::find()->select('doc_number')->from('bill_of_sale')->where(['fk_doc_type' => $id])->max('doc_number');
        if (!isset($max)) {
            $max = '0';
        }
        $array = [$type->mask, $max];

        return json_encode($array);
    }

    public function actionMunicipality($id) {
        $municipalities = \app\models\Municipality::find()->where(['fk_department' => $id])->all();
        foreach ($municipalities as $munic1) {
            $munic2[$munic1->id] = $munic1->municipality;
        }
        return json_encode($munic2);
    }

    public function actionTaxconcept($id) {
        $retention = \app\models\Retentions::findOne($id);

        if ($retention->how_affects == 1) {
            $sign = '-';
        } elseif ($retention->how_affects == 2) {
            $sign = '';
        } elseif ($retention->how_affects == 3) {
            $sign = '+';
        }

        $percentage = $retention->value;
        $account = $retention->bill_to_pay;
        $min_value = $retention->min_base_value;
        if ($retention->movement_type == '1') {
            $mov_type = 'Débito';
        } elseif ($retention->movement_type == '2') {
            $mov_type = 'Crédito';
        }

        $retention_array = ['sign' => $sign, 'percentage' => $percentage, 'account' => $account, 'min_value' => $min_value, 'movement_type' => $mov_type];
        return json_encode($retention_array);
    }

}
