<?php

namespace app\controllers;

use app\models\Thirdparties;
use app\models\ThirdpartiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ThirdpartiesController implements the CRUD actions for Thirdparties model.
 */
class ThirdpartiesController extends Controller {

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
     * Lists all Thirdparties models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ThirdpartiesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->where(['fk_third' => null]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Thirdparties model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $contact_model = \app\models\Contacts::findOne(['fk_third' => $id]);
        $files_model = \app\models\Thirdattachedfiles::findAll(['fk_third' => $id]);
        $model->doc_type = \Yii::$app->params['third_parties']['doc_type'][$model->doc_type];
        if (isset($model->fk_municipality)) {
            $model->fk_municipality = $model->fkMunicipality->municipality;
        }
        $search_branches = new ThirdpartiesSearch();
        $data_branches = $search_branches->search($this->request->queryParams);
        $data_branches->query->where(['fk_third' => $id]);
        
        return $this->render('view', [
                    'model' => $model,
                    'contact_model' => $contact_model,
                    'files_model' => $files_model,
            'data_branches' => $data_branches,
            'search_branches' => $search_branches,
        ]);
    }

    /**
     * Creates a new Thirdparties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null) {
        $model = new Thirdparties();
        if (isset($id)) {
            $model->fk_third = $id;
            $all_branches = Thirdparties::find()->select('code')->where(['fk_third' => $id])->all();
            $branches_array = array();
            foreach($all_branches as $branch) {
                $branches_array[] = intval(substr($branch->code, strpos($branch->code, "-") + 1));
            }
            if (!empty($branches_array)) {
                $max_branch = max($branches_array) + 1;
                $model->code = "$id-$max_branch";
            } else {
                $model->code = "$id-1";                
            }
        }
        $contact_model = new \app\models\Contacts();
        $tax_clasif_model = new \app\models\Taxclassification();
        $files_model = new \app\models\Thirdattachedfiles();
        
        $doc_type = \Yii::$app->params['third_parties']['doc_type'];
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
        $option_items = '';
        $items = \app\models\Inventory::find()->all();
        foreach ($items as $item) {
            $option_items .= "<option value='$item->id'>$item->item</option>";
        }
        $banks = \Yii::$app->params['third_parties']['banks'];
        $account_type = \Yii::$app->params['third_parties']['account_type'];

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (isset($model->fk_third)) {
                    $model->fk_third = intval($model->fk_third);
                }
                $model->uploaded_photo = UploadedFile::getInstance($model, 'uploaded_photo');
                if (!empty($model->uploaded_photo)) {
                    $photo_path = "img/third_parties/";
                    $photo = $model->uploaded_photo;
                    $photo_name = "$model->code.$photo->extension";
                    if ($photo->saveAs("$photo_path/$photo_name")) {
                        $model->photo = $photo_name;
                    }
                }
                $model->uploaded_photo = null;
                if ($model->save()) {
                    $last_third = Thirdparties::find()->orderBy(['id' => SORT_DESC])->one();
                    if ($contact_model->load($this->request->post())) {
                        if ($contact_model->cell_phone !== '' || $contact_model->phone !== '' || $contact_model->email !== '' || $contact_model->web_page !== '') {
                            $contact_model->fk_third = $last_third->id;
                            $contact_model->save();
                        }
                    }
                    if ($tax_clasif_model->load($this->request->post())) {
                        $tax_clasif_model->fk_third = $last_third->id;
                        $tax_clasif_model->save();
                    }
                    $post_data = filter_input_array(INPUT_POST);
                    if (isset($post_data['product_lines'])) {
                        $lines_array = $post_data['product_lines'];
                        for ($i = 0; $i < count($lines_array); $i++) {
                            $lines_model = new \app\models\Productslines();
                            $lines_model->line = $lines_array[$i];
                            $lines_model->fk_third = $last_third->id;
                            $lines_model->save();
                        }
                    }
                    if (isset($post_data['item_element'])) {
                        $elements_array = $post_data['item_element'];
                        $units_array = $post_data['item_unit'];
                        $codes_array = $post_data['item_code'];
                        $prices_array = $post_data['item_price'];
                        $dates_array = $post_data['item_date'];
                        $last_prices_array = $post_data['item_price_last'];
                        $last_dates_array = $post_data['item_date_last'];
                        for ($j = 0; $j < count($elements_array); $j++) {
                            $items_model = new \app\models\Inventoryitems();
                            $items_model->fk_item = $elements_array[$j];
                            $items_model->code = $codes_array[$j];
                            $items_model->unit = $units_array[$j];
                            $items_model->price = $prices_array[$j];
                            $items_model->date = $dates_array[$j];
                            $items_model->last_price = $last_prices_array[$j];
                            $items_model->last_date = $last_dates_array[$j];
                            $items_model->fk_third = $last_third->id;
                            $items_model->save();
                        }
                    }
                    if (isset($post_data['purch_code'])) {
                        $purch_code_array = $post_data['purch_code'];
                        $purch_product_array = $post_data['purch_product'];
                        $purch_unit_array = $post_data['purch_unit'];
                        $purch_date_array = $post_data['purch_date'];
                        $purch_docnumber_array = $post_data['purch_docnumber'];
                        $purch_price_array = $post_data['purch_price'];
                        $purch_movetype_array = $post_data['purch_movetype'];
                        for ($j = 0; $j < count($purch_code_array); $j++) {
                            $purchased_model = new \app\models\Purchasedproducts();
                            $purchased_model->code = $purch_code_array[$j];
                            $purchased_model->product = $purch_product_array[$j];
                            $purchased_model->unit = $purch_unit_array[$j];
                            $purchased_model->date = $purch_date_array[$j];
                            $purchased_model->doc_number = $purch_docnumber_array[$j];
                            $purchased_model->price = $purch_price_array[$j];
                            $purchased_model->movement_type = $purch_movetype_array[$j];
                            $purchased_model->fk_third = $last_third->id;
                            $purchased_model->save();
                        }
                    }
                    if ($files_model->load($this->request->post())) {
                        $files_model->uploaded_files = UploadedFile::getInstances($files_model, 'uploaded_files');
                        if (!empty($files_model->uploaded_files)) {
                            $path = "uploads/third_parties/";
                            foreach ($files_model->uploaded_files as $file) {
                                $file_name = str_replace([' '], '_', $file->baseName);
                                if ($file->saveAs("$path/$model->code-$file_name.$file->extension")) {
                                    $third_files_model = new \app\models\Thirdattachedfiles();
                                    $third_files_model->file = "$model->code-$file_name.$file->extension";
                                    $third_files_model->fk_third = $last_third->id;
                                    $third_files_model->save();
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'contact_model' => $contact_model,
                    'munic' => array(),
                    'depts' => $option_depts,
                    'tax_clasif_model' => $tax_clasif_model,
                    'economic_activity' => $economic_activity,
                    'tax_profiles' => $tax_profiles,
                    'option_items' => $option_items,
                    'banks' => $banks,
                    'account_type' => $account_type,
                    'files_model' => $files_model,
                    'files_array' => array(),
        ]);
    }

    /**
     * Updates an existing Thirdparties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $files_model = new \app\models\Thirdattachedfiles();
        $doc_type = \Yii::$app->params['third_parties']['doc_type'];
        $contact_model = \app\models\Contacts::findOne(['fk_third' => $id]);
        if (!isset($contact_model->id)) {
            $contact_model = new \app\models\Contacts();
        }
        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
        $tax_clasif_model = \app\models\Taxclassification::findOne(['fk_third' => $id]);
        $economic_activity = array();
        $all_ea_list = \app\models\Economicactivity::find()->all();
        foreach ($all_ea_list as $econ_act) {
            $economic_activity[$econ_act->id] = "$econ_act->code - $econ_act->name";
        }
        $tax_profiles = \Yii::$app->params['company']['tax_profiles'];
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
        $banks = \Yii::$app->params['third_parties']['banks'];
        $account_type = \Yii::$app->params['third_parties']['account_type'];
        $option_items = '';
        $items = \app\models\Inventory::find()->all();
        foreach ($items as $item) {
            $option_items .= "<option value='$item->id'>$item->item</option>";
        }
        $all_uploads_models = \app\models\Thirdattachedfiles::findall(['fk_third' => $id]);
        $files_array = array();
        $files_name = array();
        foreach ($all_uploads_models as $uploaded) {
            $files_array[] = "../uploads/third_parties/$uploaded->file";
            $files_name[] = ['caption' => $uploaded->file];
        }
        $all_lines = \app\models\Productslines::findAll(['fk_third' => $id]);
        $all_items = \app\models\Inventoryitems::findAll(['fk_third' => $id]);
        $all_purchased = \app\models\Purchasedproducts::findAll(['fk_third' => $id]);

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (isset($model->photo)) {
                    $photo_path_1 = 'img/third_parties/' . $model->photo;
                    if (is_file($photo_path_1)) {
                        unlink($photo_path_1);
                    }
                }
                $model->uploaded_photo = UploadedFile::getInstance($model, 'uploaded_photo');
                if (!empty($model->uploaded_photo)) {
                    $photo_path = "img/third_parties/";
                    $photo = $model->uploaded_photo;
                    $photo_name = "$model->code.$photo->extension";
                    if ($photo->saveAs("$photo_path/$photo_name")) {
                        $model->photo = $photo_name;
                    }
                }
                $model->uploaded_photo = null;
                if ($model->save()) {
                    if ($contact_model->load($this->request->post())) {
                        if ($contact_model->cell_phone !== '' || $contact_model->phone !== '' || $contact_model->email !== '' || $contact_model->web_page !== '') {
                            $contact_model->fk_third = $id;
                            $contact_model->save();
                        }
                    }
                    if ($tax_clasif_model->load($this->request->post())) {
                        $tax_clasif_model->save();
                    }

                    $post_data = filter_input_array(INPUT_POST);
                    \app\models\Productslines::deleteAll(['fk_third' => $id]);
                    if (isset($post_data['product_lines'])) {
                        $lines_array = $post_data['product_lines'];
                        for ($i = 0; $i < count($lines_array); $i++) {
                            $lines_model = new \app\models\Productslines();
                            $lines_model->line = $lines_array[$i];
                            $lines_model->fk_third = $id;
                            $lines_model->save();
                        }
                    }
                    \app\models\Inventoryitems::deleteAll(['fk_third' => $id]);
                    if (isset($post_data['item_element'])) {
                        $elements_array = $post_data['item_element'];
                        $units_array = $post_data['item_unit'];
                        $codes_array = $post_data['item_code'];
                        $prices_array = $post_data['item_price'];
                        $dates_array = $post_data['item_date'];
                        $last_prices_array = $post_data['item_price_last'];
                        $last_dates_array = $post_data['item_date_last'];
                        for ($j = 0; $j < count($elements_array); $j++) {
                            $items_model = new \app\models\Inventoryitems();
                            $items_model->fk_item = $elements_array[$j];
                            $items_model->code = $codes_array[$j];
                            $items_model->unit = $units_array[$j];
                            $items_model->price = $prices_array[$j];
                            $items_model->date = $dates_array[$j];
                            $items_model->last_price = $last_prices_array[$j];
                            $items_model->last_date = $last_dates_array[$j];
                            $items_model->fk_third = $id;
                            $items_model->save();
                        }
                    }
                    \app\models\Purchasedproducts::deleteAll(['fk_third' => $id]);
                    if (isset($post_data['purch_code'])) {
                        $purch_code_array = $post_data['purch_code'];
                        $purch_product_array = $post_data['purch_product'];
                        $purch_unit_array = $post_data['purch_unit'];
                        $purch_date_array = $post_data['purch_date'];
                        $purch_docnumber_array = $post_data['purch_docnumber'];
                        $purch_price_array = $post_data['purch_price'];
                        $purch_movetype_array = $post_data['purch_movetype'];
                        for ($j = 0; $j < count($purch_code_array); $j++) {
                            $purchased_model = new \app\models\Purchasedproducts();
                            $purchased_model->code = $purch_code_array[$j];
                            $purchased_model->product = $purch_product_array[$j];
                            $purchased_model->unit = $purch_unit_array[$j];
                            $purchased_model->date = $purch_date_array[$j];
                            $purchased_model->doc_number = $purch_docnumber_array[$j];
                            $purchased_model->price = $purch_price_array[$j];
                            $purchased_model->movement_type = $purch_movetype_array[$j];
                            $purchased_model->fk_third = $id;
                            $purchased_model->save();
                        }
                    }
                    if ($files_model->load($this->request->post())) {
                        $previous_files_model = \app\models\Thirdattachedfiles::findAll(['fk_third' => $id]);
                        if (!empty($previous_files_model)) {
                            foreach ($previous_files_model as $file_up) {
                                $file_path = 'uploads/third_parties/' . $file_up->file;
                                if (is_file($file_path)) {
                                    unlink($file_path);
                                }
                            }
                        }
                        \app\models\Thirdattachedfiles::deleteAll(['fk_third' => $id]);
                        $files_model->uploaded_files = UploadedFile::getInstances($files_model, 'uploaded_files');
                        if (!empty($files_model->uploaded_files)) {
                            $path = "uploads/third_parties/";
                            foreach ($files_model->uploaded_files as $file) {
                                $file_name = str_replace([' '], '_', $file->baseName);
                                if ($file->saveAs("$path/$model->code-$file_name.$file->extension")) {
                                    $third_files_model = new \app\models\Thirdattachedfiles();
                                    $third_files_model->file = "$model->code-$file_name.$file->extension";
                                    $third_files_model->fk_third = $id;
                                    $third_files_model->save();
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

//        print '<pre>';
//        print_r($files_array);
//        print '</pre>';
//        die();

        return $this->render('update', [
                    'model' => $model,
                    'doc_type' => $doc_type,
                    'contact_model' => $contact_model,
                    'munic' => $option_muni,
                    'depts' => $option_depts,
                    'banks' => $banks,
                    'account_type' => $account_type,
                    'tax_clasif_model' => $tax_clasif_model,
                    'economic_activity' => $economic_activity,
                    'tax_profiles' => $tax_profiles,
                    'option_items' => $option_items,
                    'files_array' => $files_array,
                    'files_model' => $files_model,
                    'files_name' => $files_name,
                    'all_lines' => $all_lines,
                    'all_items' => $all_items,
                    'all_purchased' => $all_purchased,
        ]);
    }

    /**
     * Deletes an existing Thirdparties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        \app\models\Contacts::deleteAll(['fk_third' => $id]);
        \app\models\Taxclassification::deleteAll(['fk_third' => $id]);
        \app\models\Productslines::deleteAll(['fk_third' => $id]);
        \app\models\Inventoryitems::deleteAll(['fk_third' => $id]);
        \app\models\Purchasedproducts::deleteAll(['fk_third' => $id]);
        $model = $this->findModel($id);
        if (isset($model->photo)) {
            $photo_path_1 = 'img/third_parties/' . $model->photo;
            if (is_file($photo_path_1)) {
                unlink($photo_path_1);
            }
        }
        $previous_files_model = \app\models\Thirdattachedfiles::findAll(['fk_third' => $id]);
        if (!empty($previous_files_model)) {
            foreach ($previous_files_model as $file_up) {
                $file_path = 'uploads/third_parties/' . $file_up->file;
                if (is_file($file_path)) {
                    unlink($file_path);
                }
            }
        }
        \app\models\Thirdattachedfiles::deleteAll(['fk_third' => $id]);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Thirdparties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Thirdparties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Thirdparties::findOne($id)) !== null) {
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
