<?php

namespace app\controllers;

use app\models\Company;
use app\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller {

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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $search_hq = new \app\models\HeadquartersSearch();
        $data_hq = $search_hq->search($this->request->queryParams);

        $search_cc = new \app\models\CostcenterSearch();
        $data_cc = $search_cc->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'search_hq' => $search_hq,
                    'data_hq' => $data_hq,
                    'search_cc' => $search_cc,
                    'data_cc' => $data_cc,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        if ($model->fk_municipality) {
            $model->fk_municipality = $model->fkMunicipality->municipality;
        }
        $label = \app\models\Companylabel::find()->select(['logo'])->where(['fk_company' => $id])->one();
        if ($label) {
            $logo = $label->logo;
        } else {
            $logo = '';
        }
        $contacts_model = \app\models\Contacts::findOne(['fk_company' => $id]);
        $search_hq = new \app\models\HeadquartersSearch();
        $data_hq = $search_hq->search($this->request->queryParams);
        $data_hq->query->where(['fk_company' => $id]);
        $search_cc = new \app\models\CostcenterSearch();
        $data_cc = $search_cc->search($this->request->queryParams);
        $data_cc->query->andWhere(['fk_company' => $id, 'fk_headquarter' => null, 'fk_cost_center' => null]);

        return $this->render('view', [
                    'model' => $model,
                    'contacts_model' => $contacts_model,
                    'logo' => $logo,
                    'search_hq' => $search_hq,
                    'data_hq' => $data_hq,
                    'search_cc' => $search_cc,
                    'data_cc' => $data_cc,
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Company();
        $contacts_model = new \app\models\Contacts();
        $tax_clasif_model = new \app\models\Taxclassification();
        $label_model = new \app\models\Companylabel();

        $doc_type = \Yii::$app->params['company']['doc_type'];
        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
        foreach ($depts as $dept) {
            $option_depts .= "<option value='$dept->id'>$dept->department</option>";
        }
        $economic_activity = array();
        $all_ea_list = \app\models\Economicactivity::find()->all();
        foreach ($all_ea_list as $econ_act) {
            $economic_activity[$econ_act->id] = "$econ_act->code - $econ_act->name";
        }
        $tax_profiles = \Yii::$app->params['company']['tax_profiles'];
        $header_type = \Yii::$app->params['company']['header_type'];
        $model->doc_type = 4;
        $colors = ['#333', '#333', '#333', '#333', '#333'];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->color = filter_input(INPUT_POST, 'model_color');
                if ($model->save()) {
                    $last_company = Company::find()->select('id')->orderBy(['id' => SORT_DESC])->one();
                    $contacts_model->load($this->request->post());
                    $contacts_model->fk_company = $last_company->id;
                    $contacts_model->save();
                    $tax_clasif_model->load($this->request->post());
                    $tax_clasif_model->fk_company = $last_company->id;
                    $tax_clasif_model->save();
                    $label_model->load($this->request->post());
                    $label_model->fk_company = $last_company->id;
                    $label_model->mt_color = filter_input(INPUT_POST, 'mt_color');
                    $label_model->subt_color = filter_input(INPUT_POST, 'subt_color');
                    $label_model->detail_color = filter_input(INPUT_POST, 'detail_color');
                    $label_model->footer_color = filter_input(INPUT_POST, 'footer_color');
                    $logo_file = UploadedFile::getInstance($label_model, 'logo_file');
                    if (!empty($logo_file)) {
                        $path = "img/company/";
                        $logo_name = str_replace([' '], '_', $model->business_name);
                        if ($logo_file->saveAs("$path/$last_company->id-$logo_name.$logo_file->extension")) {
                            $label_model->logo = "$last_company->id-$logo_name.$logo_file->extension";
                        }
                    }
                    $label_model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $model->loadDefaultValues();
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'contacts_model' => $contacts_model,
                    'munic' => array(),
                    'depts' => $option_depts,
                    'tax_clasif_model' => $tax_clasif_model,
                    'economic_activity' => $economic_activity,
                    'tax_profile' => $tax_profiles,
                    'label_model' => $label_model,
                    'header_type' => $header_type,
                    'colors' => $colors,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $contacts_model = \app\models\Contacts::findOne(['fk_company' => $id]);
        if (!$contacts_model) {
            $contacts_model = new \app\models\Contacts();
        }
        $tax_clasif_model = \app\models\Taxclassification::findOne(['fk_company' => $id]);
        if (!$tax_clasif_model) {
            $tax_clasif_model = new \app\models\Taxclassification();
        }
        $label_model = \app\models\Companylabel::findOne(['fk_company' => $id]);
        if (!$label_model) {
            $label_model = new \app\models\Companylabel();
        }

        $doc_type = \Yii::$app->params['company']['doc_type'];

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

        $economic_activity = array();
        $all_ea_list = \app\models\Economicactivity::find()->all();
        foreach ($all_ea_list as $econ_act) {
            $economic_activity[$econ_act->id] = "$econ_act->code - $econ_act->name";
        }

        $tax_profiles = \Yii::$app->params['company']['tax_profiles'];
        $header_type = \Yii::$app->params['company']['header_type'];

        $colors = ['#333', '#333', '#333', '#333', '#333'];
        if (isset($model->color)) {
            $colors[0] = $model->color;
        }
        if (isset($label_model->mt_color)) {
            $colors[1] = $label_model->mt_color;
        }
        if (isset($label_model->subt_color)) {
            $colors[2] = $label_model->subt_color;
        }
        if (isset($label_model->detail_color)) {
            $colors[3] = $label_model->detail_color;
        }
        if (isset($label_model->footer_color)) {
            $colors[4] = $label_model->footer_color;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->color = filter_input(INPUT_POST, 'model_color');
                if ($model->save()) {
                    $contacts_model->load($this->request->post());
                    $contacts_model->fk_company = $id;
                    $contacts_model->save();
                    $tax_clasif_model->load($this->request->post());
                    $tax_clasif_model->fk_company = $id;
                    $tax_clasif_model->save();
                    $label_model->load($this->request->post());
                    $label_model->fk_company = $id;
                    $label_model->mt_color = filter_input(INPUT_POST, 'mt_color');
                    $label_model->subt_color = filter_input(INPUT_POST, 'subt_color');
                    $label_model->detail_color = filter_input(INPUT_POST, 'detail_color');
                    $label_model->footer_color = filter_input(INPUT_POST, 'footer_color');
                    $logo_file = UploadedFile::getInstance($label_model, 'logo_file');
                    if (!empty($logo_file)) {
                        if (isset($label_model->logo)) {
                            $file_path = 'img/company/' . $label_model->logo;
                            if (is_file($file_path)) {
                                unlink($file_path);
                            }
                        }
                        $path = "img/company/";
                        $logo_name = str_replace([' '], '_', $model->business_name);
                        if ($logo_file->saveAs("$path/$id-$logo_name.$logo_file->extension")) {
                            $label_model->logo = "$id-$logo_name.$logo_file->extension";
                        }
                    }
                    $label_model->save();
                    return $this->redirect(['view', 'id' => $id]);
                } else {
                    $model->loadDefaultValues();
                }
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'contacts_model' => $contacts_model,
                    'munic' => $option_muni,
                    'depts' => $option_depts,
                    'tax_clasif_model' => $tax_clasif_model,
                    'economic_activity' => $economic_activity,
                    'tax_profile' => $tax_profiles,
                    'label_model' => $label_model,
                    'header_type' => $header_type,
                    'colors' => $colors,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        \app\models\Contacts::deleteAll(['fk_company' => $id]);
        \app\models\Taxclassification::deleteAll(['fk_company' => $id]);

        $label_model = \app\models\Companylabel::findOne(['fk_company' => $id]);
        if (isset($label_model->logo)) {
            $file_path = 'img/company/' . $label_model->logo;
            if (is_file($file_path)) {
                unlink($file_path);
            }
        }
        $label_model->delete();

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMunicipality($id) {
        $municipalities = \app\models\Municipality::find()->where(['fk_department' => $id])->all();
        foreach ($municipalities as $munic1) {
            $munic2[$munic1->id] = $munic1->municipality;
        }
        return json_encode($munic2);
    }

}
