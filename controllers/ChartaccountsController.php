<?php

namespace app\controllers;

use app\models\Chartaccounts;
use app\models\ChartaccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ChartaccountsController implements the CRUD actions for Chartaccounts model.
 */
class ChartaccountsController extends Controller {

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
     * Lists all Chartaccounts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChartaccountsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Chartaccounts model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        if ($model->handle_third_parties == 1) {
            $model->handle_third_parties = 'Sí';
        } else {
            $model->handle_third_parties = 'No';
        }
        if ($model->controls_indebtedness == 1) {
            $model->controls_indebtedness = 'Sí';
        } else {
            $model->controls_indebtedness = 'No';
        }
        if ($model->handle_references == 1) {
            $model->handle_references = 'Sí';
        } else {
            $model->handle_references = 'No';
        }
        if ($model->discriminate_by_third_party == 1) {
            $model->discriminate_by_third_party = 'Sí';
        } else {
            $model->discriminate_by_third_party = 'No';
        }
        if ($model->demands_base_value == 1) {
            $model->demands_base_value = 'Sí';
        } else {
            $model->demands_base_value = 'No';
        }
        if ($model->visible_in_selection == 1) {
            $model->visible_in_selection = 'Sí';
        } else {
            $model->visible_in_selection = 'No';
        }
        if ($model->local_account == 1) {
            $model->local_account = 'Sí';
        } else {
            $model->local_account = 'No';
        }
        if ($model->niif_account == 1) {
            $model->niif_account = 'Sí';
        } else {
            $model->niif_account = 'No';
        }
        if ($model->use_niif_equivalent_account == 1) {
            $model->use_niif_equivalent_account = 'Sí';
        } else {
            $model->use_niif_equivalent_account = 'No';
        }
        if ($model->fk_account == null) {
            $model->fk_account = '';
        } else {
            $fk_account = $this->findModel($model->fk_account);
            $model->fk_account = $fk_account->code;
        }

        $account_type = \app\models\Accounttype::findOne($model->fk_account_type);
        if (isset($model->fk_account_type)) {
            $model->fk_account_type = $account_type->type;
        } else {
            $model->fk_account_type = '';
        }

        if ($model->class == 1) {
            $model->class = \Yii::$app->params['account_classes']['1'];
            $taxes_conf = \app\models\Taxesconfiguration::find()->where(['fk_chart_account' => $model->id])->one();
            if ($taxes_conf->iva != null) {
                $iva = \app\models\Retentions::findOne($taxes_conf->iva);
                $taxes_conf->iva = $iva->code;
            }
            if ($taxes_conf->retention != null) {
                $retention = \app\models\Retentions::findOne($taxes_conf->retention);
                $taxes_conf->retention = $retention->code;
            }
            if ($taxes_conf->rete_ica != null) {
                $rete_ica = \app\models\Retentions::findOne($taxes_conf->rete_ica);
                $taxes_conf->rete_ica = $rete_ica->code;
            }
            if ($taxes_conf->tax_cree != null) {
                $tax_cree = \app\models\Retentions::findOne($taxes_conf->tax_cree);
                $taxes_conf->tax_cree = $tax_cree->code;
            }
            if ($taxes_conf->auto_retention != null) {
                $auto_retention = \app\models\Retentions::findOne($taxes_conf->auto_retention);
                $taxes_conf->auto_retention = $auto_retention->code;
            }
            if ($taxes_conf->other != null) {
                $other = \app\models\Retentions::findOne($taxes_conf->other);
                $taxes_conf->other = $other->code;
            }
            if ($taxes_conf->other_2 != null) {
                $other_2 = \app\models\Retentions::findOne($taxes_conf->other_2);
                $taxes_conf->other_2 = $other_2->code;
            }
        } else {
            $taxes_conf = '';
        }
        if ($model->class == 2) {
            $model->class = \Yii::$app->params['account_classes']['2'];
        } elseif ($model->class == 3) {
            $model->class = \Yii::$app->params['account_classes']['3'];
            $tax = \app\models\Taxes::findOne($model->fk_tax);
            $model->fk_tax = $tax->tax;
        } elseif ($model->class == 4) {
            $model->class = \Yii::$app->params['account_classes']['4'];
        }
        if ($model->class == 5) {
            $model->class = \Yii::$app->params['account_classes']['5'];
//            $all_concepts = \app\models\Payrolltaxes::find()->select(['retention'])->from('retentions')->leftJoin('payroll_taxes', "retentions.id = payroll_taxes.concept")->where(['fk_chart_account' => "$model->id"])->all();
            $all_concepts = \app\models\Payrolltaxes::find()->where(['fk_chart_account' => $model->id])->all();

            $concept_array = array();
            if ($all_concepts != null) {
                foreach ($all_concepts as $concepts) {
                    $concept = \app\models\Retentions::findOne($concepts->concept);
                    $concept_array[] = $concept->name;
                }
            }
        } else {
            $concept_array = array();
        }

        return $this->render('view', [
                    'model' => $model,
                    'taxes_conf' => $taxes_conf,
                    'concepts' => $concept_array,
        ]);
    }

    /**
     * Creates a new Chartaccounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $model = new Chartaccounts();
        $taxes_conf_model = new \app\models\Taxesconfiguration;

        $option_accounts = array();
        if ($id == 'new') {
            $base_accounts = Chartaccounts::find()->select(['id', 'code', 'account'])->where(['length(code)' => '1'])->all();
        } else {
            $base_accounts = Chartaccounts::find()->select(['id', 'code', 'account'])->orderBy(['code' => SORT_ASC])->all();
            $model->fk_account = $id;
        }
        foreach ($base_accounts as $base_acc) {
            $option_accounts[$base_acc->id] = "$base_acc->code - $base_acc->account";
        }
//        $option_accounts['all'] = "Mostrar Todas";        

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->class == 1 && $taxes_conf_model->load($this->request->post())) {
                    if ($model->validate() && $taxes_conf_model->validate()) {
                        if ($model->save()) {
                            $last_chart = \app\models\Chartaccounts::find()->orderBy(['id' => SORT_DESC])->one();
                            $taxes_conf_model->fk_chart_account = $last_chart->id;
                            if ($taxes_conf_model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                $model->loadDefaultValues();
                                $taxes_conf_model->loadDefaultValues();
                            }
                        } else {
                            $model->loadDefaultValues();
                        }
                    } else {
                        \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                    }
                }

                if ($model->class == 2 || $model->class == 3 || $model->class == 4) {
                    if ($model->validate()) {
                        if ($model->save()) {
                            $last_chart = \app\models\Chartaccounts::find()->orderBy(['id' => SORT_DESC])->one();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $model->loadDefaultValues();
                        }
                    } else {
                        \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                    }
                }

                if ($model->class == 5) {
                    if ($model->validate()) {
                        if ($model->save()) {
                            $last_chart = \app\models\Chartaccounts::find()->orderBy(['id' => SORT_DESC])->one();
                            $concepts_json = filter_input(INPUT_POST, 'concepts_input');
                            $concepts = json_decode($concepts_json, true);
                            if (count($concepts) !== 0) {
                                foreach ($concepts as $key => $value) {
                                    $payroll_model = new \app\models\Payrolltaxes;
                                    $payroll_model->fk_chart_account = $last_chart->id;
                                    $payroll_model->concept = $value;
                                    if ($payroll_model->save()) {
                                        if ($key === array_key_last($concepts)) {
                                            return $this->redirect(['view', 'id' => $model->id]);
                                        }
                                    } else {
                                        $model->loadDefaultValues();
                                    }
                                }
                            } else {
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } else {
                            $model->loadDefaultValues();
                        }
                    } else {
                        \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                    }
                }
            }
        }

        $account = array();
        $all_accounts = Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $account_type = array();
        $all_accounts_types = \app\models\Accounttype::find()->all();
        foreach ($all_accounts_types as $accounts_types) {
            $account_type[$accounts_types->id] = $accounts_types->type;
        }

        $tax = array();
        $all_taxes = \app\models\Taxes::find()->all();
        foreach ($all_taxes as $taxes) {
            $tax[$taxes->id] = $taxes->tax;
        }

        $account_class = array(1 => 'Normal', 2 => 'De Efectivo', 3 => 'De Impuestos', 4 => 'De Ajustes por Inflación', 5 => 'De Nómina Contable');

        $retention = array();
        $option_retentions = '';
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
            $option_retentions .= "<option value='$retentions->id'>$retentions->code - $retentions->name - $retentions->validity_start</option>";
        }

        $all_concepts = array();

        return $this->render('create', [
                    'model' => $model,
                    'accounts' => $account,
                    'accounts_types' => $account_type,
                    'accounts_classes' => $account_class,
                    'taxes_conf_model' => $taxes_conf_model,
                    'retentions' => $retention,
                    'taxes' => $tax,
                    'option_retentions' => $option_retentions,
                    'all_concepts' => $all_concepts,
                    'option_accounts' => $option_accounts,
                    'account_id' => $id,
        ]);
    }

    /**
     * Updates an existing Chartaccounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $account = array();
        $all_accounts = Chartaccounts::find()->all();
        foreach ($all_accounts as $accounts) {
            $account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        $account_type = array();
        $all_accounts_types = \app\models\Accounttype::find()->all();
        foreach ($all_accounts_types as $accounts_types) {
            $account_type[$accounts_types->id] = $accounts_types->type;
        }

        $account_class = array(1 => 'Normal', 2 => 'De Efectivo', 3 => 'De Impuestos', 4 => 'De Ajustes por Inflación', 5 => 'De Nómina Contable');

        $retention = array();
        $option_retentions = '';
        $all_retentions = \app\models\Retentions::find()->all();
        foreach ($all_retentions as $retentions) {
            $retention[$retentions->id] = "$retentions->code - $retentions->name - $retentions->validity_start";
            $option_retentions .= "<option value='$retentions->id'>$retentions->code - $retentions->name - $retentions->validity_start</option>";
        }

        if ($model->class == 1) {
            $taxes_conf_model = \app\models\Taxesconfiguration::findOne(['fk_chart_account' => $id]);
            if ($taxes_conf_model->iva == null) {
                $taxes_conf_model->iva = '';
            }
            if ($taxes_conf_model->retention == null) {
                $taxes_conf_model->retention = '';
            }
            if ($taxes_conf_model->rete_ica == null) {
                $taxes_conf_model->rete_ica = '';
            }
            if ($taxes_conf_model->tax_cree == null) {
                $taxes_conf_model->tax_cree = '';
            }
            if ($taxes_conf_model->auto_retention == null) {
                $taxes_conf_model->auto_retention = '';
            }
            if ($taxes_conf_model->other == null) {
                $taxes_conf_model->other = '';
            }
            if ($taxes_conf_model->other_2 == null) {
                $taxes_conf_model->other_2 = '';
            }
        } else {
            $taxes_conf_model = new \app\models\Taxesconfiguration;
        }


        $tax = array();
        $all_taxes = \app\models\Taxes::find()->all();
        foreach ($all_taxes as $taxes) {
            $tax[$taxes->id] = $taxes->tax;
        }

        if ($model->class == 5) {
            $all_concepts = \app\models\Payrolltaxes::find()->where(['fk_chart_account' => $model->id])->all();
        } else {
            $all_concepts = null;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                if ($model->class == 1 && $taxes_conf_model->load($this->request->post())) {
                    if ($model->validate() && $taxes_conf_model->validate()) {
                        $model->fk_tax = '';
                        if ($all_concepts !== null) {
                            foreach ($all_concepts as $concepts) {
                                $concepts_model = \app\models\Payrolltaxes::findOne($concepts->id);
                                $concepts_model->delete();
                            }
                        }
                        if ($model->save()) {
                            $taxes_conf_model->fk_chart_account = $model->id;
                            if ($taxes_conf_model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {
                                $model->loadDefaultValues();
                                $taxes_conf_model->loadDefaultValues();
                            }
                        } else {
                            $model->loadDefaultValues();
                            $taxes_conf_model->loadDefaultValues();
                        }
                    } else {
                        \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                    }
                }

                if ($model->validate()) {
                    if ($model->class == 2 || $model->class == 4) {
                        $model->fk_tax = '';
                        if ($all_concepts !== null) {
                            foreach ($all_concepts as $concepts) {
                                $concepts_model = \app\models\Payrolltaxes::findOne($concepts->id);
                                $concepts_model->delete();
                            }
                        }
                        if (isset($taxes_conf_model->id)) {
                            $taxes_conf_model->delete();
                        }
                        if ($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $model->loadDefaultValues();
                        }
                    }

                    if ($model->class == 3) {
                        if (isset($taxes_conf_model->id)) {
                            $taxes_conf_model->delete();
                        }
                        if ($all_concepts !== null) {
                            foreach ($all_concepts as $concepts) {
                                $concepts_model = \app\models\Payrolltaxes::findOne($concepts->id);
                                $concepts_model->delete();
                            }
                        }
                        if ($model->save()) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            $model->loadDefaultValues();
                        }
                    }
                } else {
                    \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                }

                if ($model->class == 5) {
                    if ($model->validate()) {
                        $model->fk_tax = '';
                        if (isset($taxes_conf_model->id)) {
                            $taxes_conf_model->delete();
                        }
                        if ($all_concepts !== null) {
                            foreach ($all_concepts as $concepts) {
                                $concepts_model = \app\models\Payrolltaxes::findOne($concepts->id);
                                $concepts_model->delete();
                            }
                        }
                        if ($model->save()) {
                            $concepts = array();
                            $concepts_json = filter_input(INPUT_POST, 'concepts_input');
                            $concepts = json_decode($concepts_json, true);
                            if (count($concepts) !== 0) {
                                foreach ($concepts as $key => $value) {
                                    $payroll_model = new \app\models\Payrolltaxes;
                                    $payroll_model->concept = $value;
                                    $payroll_model->fk_chart_account = $model->id;
                                    if ($payroll_model->save()) {
                                        if ($key === array_key_last($concepts)) {
                                            return $this->redirect(['view', 'id' => $model->id]);
                                        }
                                    } else {
                                        $model->loadDefaultValues();
                                    }
                                }
                            } else {
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } else {
                            $model->loadDefaultValues();
                        }
                    } else {
                        \Yii::$app->session->setFlash('errors', 'El formulario tiene errores!');
                    }
                }
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'accounts' => $account,
                    'accounts_types' => $account_type,
                    'accounts_classes' => $account_class,
                    'taxes_conf_model' => $taxes_conf_model,
                    'retentions' => $retention,
                    'taxes' => $tax,
                    'option_retentions' => $option_retentions,
                    'all_concepts' => $all_concepts
        ]);
    }

    /**
     * Deletes an existing Chartaccounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        $model = $this->findModel($id);

        if ($model->class == 1) {
            $taxes_conf_model = \app\models\Taxesconfiguration::findOne(['fk_chart_account' => $id]);
            $taxes_conf_model->delete();
        }
        if ($model->class == 5) {
            $all_concepts = \app\models\Payrolltaxes::deleteAll(['fk_chart_account' => $id]);
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Chartaccounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Chartaccounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Chartaccounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAjaxValidation() {
        $model = new Chartaccounts();

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionPayroll() {
        $all_payroll_taxes = \app\models\Payrolltaxes::find()->all();
        foreach ($all_payroll_taxes as $taxes) {
            $concept[$taxes->id] = $taxes->tax;
        }
        return json_encode($concept);
    }

    public function actionAccount($id) {
        $option_account = array();
        if ($id == '0') {
            $all_accounts = Chartaccounts::find()->select(['id', 'code', 'account'])->where(['length(code)' => '1'])->all();
        } elseif ($id == 'all') {
            $all_accounts = Chartaccounts::find()->select(['id', 'code', 'account'])->orderBy(['code' => SORT_ASC])->all();
        } else {
            $all_accounts = Chartaccounts::find()->select(['code', 'id', 'account'])->where(['fk_account' => $id])->all();
        }

        foreach ($all_accounts as $accounts) {
            $option_account[$accounts->id] = "$accounts->code - $accounts->account";
        }

        return json_encode($option_account);
    }

    public function actionAddaccount($id) {
        if ($id !== 'new') {
            if ($id !== '0' && $id !== 'all') {
                $account = $this->findModel($id);
                $acc_code = $account->code;
                $max = Chartaccounts::find()->select('code')->from('chart_accounts')->where(['fk_account' => $id])->max('code');
            } else {
                $max = 0;
                $acc_code = '';
            }

            $array = ['acc_code' => $acc_code, 'max_code' => $max];
            return json_encode($array);
        }
    }

}
