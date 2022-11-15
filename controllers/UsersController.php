<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'access' => [
                        'class' => AccessControl::className(),
                        'rules' => [
                            [
                                'allow' => true,
                                'roles' => ['@']
                            ]
                        ]
                    ],
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $municipality = \app\models\Municipality::findOne($model->fk_municipality);
        $munic = $municipality->municipality;

        return $this->render('view', [
                    'model' => $model,
                    'municipality' => $munic,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Users();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->password = password_hash($model->password, PASSWORD_DEFAULT);
                $model->last_date = date('Y-m-d');

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->validate()) {
                    if ($model->imageFile) {
                        $photo_name = str_replace(['@', '.'], '_', $model->email) . '.' . $model->imageFile->extension;
                        $file_path = 'img/' . $photo_name;
                        if ($model->imageFile->saveAs($file_path)) {
                            $model->photo = $photo_name;
                        }
                    }
                }

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
        foreach ($depts as $dept) {
            $option_depts .= "<option value='$dept->id'>$dept->department</option>";
        }

        $gender = array("Masculino" => "Masculino", "Femenino" => "Femenino");
        $user_type = array("Administrador" => "Administrador", "Contador" => "Contador", "Ingeniero" => "Ingeniero", "Oficina" => "Oficina", "Jefe Oficina" => "Jefe Oficina", "Jefe Contabilidad" => "Jefe Contabilidad");

        return $this->render('create', [
                    'model' => $model,
                    'gender' => $gender,
                    'user_type' => $user_type,
                    'munic' => array(),
                    'depts' => $option_depts,
        ]);
    }

    public function actionAjaxValidation() {
        $model = new Users();     

        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->password = password_hash($model->password, PASSWORD_DEFAULT);
            $model->last_date = date('Y-m-d');

            $file_path = 'img/' . $model->photo;
            if (filetype($file_path) == 'jpg' || filetype($file_path) == 'jpeg' || filetype($file_path) == 'png') {
                unlink($file_path);
            }
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->validate()) {
                if ($model->imageFile) {
                    $photo_name = str_replace(['@', '.'], '_', $model->email) . '.' . $model->imageFile->extension;
                    $file_path = 'img/' . $photo_name;
                    if ($model->imageFile->saveAs($file_path)) {
                        $model->photo = $photo_name;
                    }
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $option_depts = '';
        $depts = \app\models\Departments::find()->all();
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

        $gender = array("Masculino" => "Masculino", "Femenino" => "Femenino");
        $user_type = array("Administrador" => "Administrador", "Contador" => "Contador", "Ingeniero" => "Ingeniero", "Oficina" => "Oficina", "Jefe Oficina" => "Jefe Oficina", "Jefe Contabilidad" => "Jefe Contabilidad");

        return $this->render('update', [
                    'model' => $model,
                    'gender' => $gender,
                    'user_type' => $user_type,
                    'munic' => $option_muni,
                    'depts' => $option_depts,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        $file_path = 'img/' . $model->photo;
        if (filetype($file_path) == 'jpg' || filetype($file_path) == 'jpeg' || filetype($file_path) == 'png') {
            unlink($file_path);
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
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

    public function actionChangepassword($id) {

        $model = Users::find()->select(['id', 'password', 'name'])->where(['id' => $id])->one();
        $model->setScenario('changePwd');
        if (isset($_POST['Users'])) {
            
            $model->attributes = $_POST['Users'];
            $valid = $model->validate();

            if ($valid) {

                $model->password = password_hash($model->new_password, PASSWORD_DEFAULT);

                if ($model->save())
                    $this->redirect(array('changepassword', 'msg' => 'successfully changed password'));
                else
                    $this->redirect(array('changepassword', 'msg' => 'password not changed'));
            }
        }

        return $this->render('changepassword', array('model' => $model));
    }

}
