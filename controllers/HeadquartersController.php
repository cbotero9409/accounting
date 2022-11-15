<?php

namespace app\controllers;

use app\models\Headquarters;
use app\models\HeadquartersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HeadquartersController implements the CRUD actions for Headquarters model.
 */
class HeadquartersController extends Controller {

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
     * Lists all Headquarters models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new HeadquartersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Headquarters model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $model->cost_center_class ? $model->cost_center_class = \Yii::$app->params['hq']['class_cc'][$model->cost_center_class] : print '';
        $model->default_category ? $model->default_category = \Yii::$app->params['hq']['categories'][$model->default_category] : print '';
        if ($model->fk_municipality) {
            $model->fk_municipality = $model->fkMunicipality->municipality;
        }
        $contacts_model = \app\models\Contacts::findOne(['fk_headquarter' => $id]);
        $all_categories = \app\models\Categorylist::findAll(['fk_headquarter' => $id]);

        $search_cc = new \app\models\CostcenterSearch();
        $data_cc = $search_cc->search($this->request->queryParams);
        $data_cc->query->andWhere(['fk_company' => $model->fk_company, 'fk_headquarter' => $id]);

        return $this->render('view', [
                    'model' => $model,
                    'contacts_model' => $contacts_model,
                    'all_categories' => $all_categories,
                    'search_cc' => $search_cc,
                    'data_cc' => $data_cc,
        ]);
    }

    /**
     * Creates a new Headquarters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_company) {
        $model = new Headquarters();
        $contacts_model = new \app\models\Contacts();
        $company = \app\models\Company::findOne($id_company);
        $model->fk_company = "$company->id - $company->business_name";
        $max_hq = Headquarters::find()->select('code')->from('headquarters')->where(['fk_company' => $id_company])->max('code');
        if (!$max_hq) {
            $max_code = '1';
        } else {
            $max_code = intval($max_hq) + 1;
            $max_code = strval($max_code);
        }
        $model->code = $max_code;
        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
        foreach ($depts as $dept) {
            $option_depts .= "<option value='$dept->id'>$dept->department</option>";
        }
        $class_cc = \Yii::$app->params['hq']['class_cc'];
        $categories = \Yii::$app->params['hq']['categories'];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_company = $company->id;
                if ($model->save()) {
                    $last_hq = \app\models\Headquarters::find()->orderBy(['id' => SORT_DESC])->one();
                    if ($contacts_model->load($this->request->post())) {
                        $contacts_model->fk_headquarter = $last_hq->id;
                        if ($contacts_model->name !== '' || $contacts_model->cell_phone !== '' || $contacts_model->phone !== '' || $contacts_model->email !== '') {
                            $contacts_model->save();
                        }
                    }
                    $post_data = filter_input_array(INPUT_POST);
                    if (isset($post_data['categ_code'])) {
                        $codes = $post_data['categ_code'];
                        $names = $post_data['categ_name'];
                        $shorts = $post_data['categ_short'];
                        $types = $post_data['categ_type'];
                        $managers = $post_data['categ_manager'];
                        $images = $post_data['categ_img'];
                        for ($i = 0; $i < count($codes); $i++) {
                            $category_list = new \app\models\Categorylist();
                            $category_list->cod_cc = $codes[$i];
                            $category_list->name = $names[$i];
                            $category_list->short_name = $shorts[$i];
                            $category_list->type = $types[$i];
                            $category_list->manager = $managers[$i];
                            $category_list->image = $images[$i];
                            $category_list->fk_headquarter = $last_hq->id;
                            $category_list->save();
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $model->loadDefaultValues();
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'contacts_model' => $contacts_model,
                    'depts' => $option_depts,
                    'munic' => [],
                    'class_cc' => $class_cc,
                    'categories' => $categories,
        ]);
    }

    /**
     * Updates an existing Headquarters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $company = \app\models\Company::findOne($model->fk_company);
        $model->fk_company = "$company->id - $company->business_name";
        $contacts_model = \app\models\Contacts::findOne(['fk_headquarter' => $id]);
        if (!$contacts_model) {
            $contacts_model = new \app\models\Contacts();
        }
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
        $class_cc = \Yii::$app->params['hq']['class_cc'];
        $categories = \Yii::$app->params['hq']['categories'];
        $all_categories = \app\models\Categorylist::findAll(['fk_headquarter' => $id]);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->fk_company = $company->id;
            if ($model->save()) {
                if ($contacts_model->load($this->request->post())) {
                    $contacts_model->fk_headquarter = $id;
                    if ($contacts_model->name !== '' || $contacts_model->cell_phone !== '' || $contacts_model->phone !== '' || $contacts_model->email !== '') {
                        $contacts_model->save();
                    }
                    \app\models\Categorylist::deleteAll(['fk_headquarter' => $id]);
                    $post_data = filter_input_array(INPUT_POST);
                    if (isset($post_data['categ_code'])) {
                        $codes = $post_data['categ_code'];
                        $names = $post_data['categ_name'];
                        $shorts = $post_data['categ_short'];
                        $types = $post_data['categ_type'];
                        $managers = $post_data['categ_manager'];
                        $images = $post_data['categ_img'];
                        for ($i = 0; $i < count($codes); $i++) {
                            $category_list = new \app\models\Categorylist();
                            $category_list->cod_cc = $codes[$i];
                            $category_list->name = $names[$i];
                            $category_list->short_name = $shorts[$i];
                            $category_list->type = $types[$i];
                            $category_list->manager = $managers[$i];
                            $category_list->image = $images[$i];
                            $category_list->fk_headquarter = $id;
                            $category_list->save();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'contacts_model' => $contacts_model,
                    'munic' => $option_muni,
                    'depts' => $option_depts,
                    'class_cc' => $class_cc,
                    'categories' => $categories,
                    'all_categories' => $all_categories,
        ]);
    }

    /**
     * Deletes an existing Headquarters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        \app\models\Contacts::deleteAll(['fk_headquarter' => $id]);
        \app\models\Categorylist::deleteAll(['fk_headquarter' => $id]);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Headquarters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Headquarters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Headquarters::findOne($id)) !== null) {
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
