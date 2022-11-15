<?php

namespace app\controllers;

use app\models\Supplier;
use app\models\SupplierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SupplierController implements the CRUD actions for Supplier model.
 */
class SupplierController extends Controller {

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
     * Lists all Supplier models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SupplierSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Supplier model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $supplier_model = $this->findModel($id);
        $contacts_model = new \app\models\Contacts;

        if ($this->request->isPost) {
            if ($contacts_model->load($this->request->post()) && $contacts_model->save()) {
                return $this->redirect(['view', 'id' => $id]);
            } else {
                $contacts_model->loadDefaultValues();
            }
        }
        
        $contacts_model->fk_supplier = $id;

        $contacts = \app\models\Contacts::find()->where(['fk_supplier' => $id])->all();
        $user = \Yii::$app->user->getId();
        $notes = \app\models\Notes::find()->where(['fk_supplier' => $id, 'fk_users' => $user])->orderBy(['id' => SORT_DESC])->all();
        $public_notes = \app\models\Notes::find()->where(['fk_supplier' => $id, 'public' => 1])->andWhere(['<>', 'fk_users', $user])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('view', [
                    'model' => $supplier_model,
                    'contacts_model' => $contacts_model,
                    'contact' => $contacts,
                    'notes' => $notes,
                    'public_notes' => $public_notes,
        ]);
    }

    /**
     * Creates a new Supplier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Supplier();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $supplier_type = ["Servicios" => "Servicios", "Transporte" => "Transporte", "Alquiler" => "Alquiler", "Materiales" => "Materiales"];

        return $this->render('create', [
                    'model' => $model,
                    'supplier_type' => $supplier_type,
        ]);
    }

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $supplier_type = ["Servicios" => "Servicios", "Transporte" => "Transporte", "Alquiler" => "Alquiler", "Materiales" => "Materiales"];
        return $this->render('update', [
                    'model' => $model,
                    'supplier_type' => $supplier_type,
        ]);
    }

    /**
     * Deletes an existing Supplier model.
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
     * Finds the Supplier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Supplier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Supplier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionViewnote($id_note) {

        $notes_model_update = \app\models\Notes::find()->where(['id' => $id_note])->one();

        return $this->renderAjax('update_notes', [
                    'notes_model_update' => $notes_model_update,
        ]);
    }

    public function actionUpdatenote() {

        $id_note = filter_input(INPUT_POST, 'id');
        $notes_model_update = \app\models\Notes::find()->where(['id' => $id_note])->one();
        if (isset($_POST['note'])) {
            $notes_model_update->note = filter_input(INPUT_POST, 'note');
            $notes_model_update->public = filter_input(INPUT_POST, 'public');
            if ($notes_model_update->validate()) {
                $notes_model_update->save();
                return json_encode(true);
            } else {
                return json_encode($notes_model_update->getErrors());
            }
        }
    }

    public function actionCreatenote() {
        $notes_model = new \app\models\Notes;

        if (isset($_POST['note'])) {
            $notes_model->fk_supplier = filter_input(INPUT_POST, 'supplier_id');
            $notes_model->note = filter_input(INPUT_POST, 'note');
            $notes_model->public = filter_input(INPUT_POST, 'public');
            $notes_model->fk_users = \Yii::$app->user->getId();
            if ($notes_model->validate()) {
                $notes_model->save();
                $last_note = \app\models\Notes::find()->orderBy(['id' => SORT_DESC])->one();
                return json_encode($last_note->id);
            } else {
                return json_encode($notes_model->getErrors());
            }
        }        

        return $this->renderAjax('create_note', [
                    'notes_model' => $notes_model,
        ]);
    }

    public function actionDeletenotes($id) {
        $id = intval($id);
        $model = \app\models\Notes::find()->where(['id' => $id])->one();
        $model->delete();
        return json_encode("deleted");
    }
    
    public function actionCreatecontact() {
        $contacts_model = new \app\models\Contacts;
        
        if (isset($_POST['name'])) {
            $contacts_model->name = filter_input(INPUT_POST, 'name');
            $contacts_model->person_type = filter_input(INPUT_POST, 'person_type');
            $contacts_model->cell_phone = filter_input(INPUT_POST, 'cellphone');
            $contacts_model->phone = filter_input(INPUT_POST, 'phone');
            $contacts_model->email = filter_input(INPUT_POST, 'email');
            $contacts_model->address = filter_input(INPUT_POST, 'address');
            $contacts_model->fk_supplier = filter_input(INPUT_POST, 'supplier_id');
            if ($contacts_model->validate()) {
                $contacts_model->save();
                $last_contact = \app\models\Contacts::find()->orderBy(['id' => SORT_DESC])->one();
                return json_encode($last_contact->id);
            } else {
                return json_encode($contacts_model->getErrors());
            }
        }
        
        return $this->renderAjax('create_contact', [
            'contacts_model' => $contacts_model,
        ]);
    }
    
    public function actionDeletecontacts($id) {
        $id = intval($id);
        $model = \app\models\Contacts::find()->where(['id' => $id])->one();
        $model->delete();
        return json_encode("deleted");
    }
    
    public function actionViewcontact($id_contact) {
        $contacts_model_update = \app\models\Contacts::find()->where(['id' => $id_contact])->one();

        return $this->renderAjax('update_contacts', [
                    'contacts_model_update' => $contacts_model_update,
        ]);
    }

    public function actionUpdatecontact() {

        $id_contact = filter_input(INPUT_POST, 'id');
        $contacts_model_update = \app\models\Contacts::find()->where(['id' => $id_contact])->one();
        if (isset($_POST['name'])) {
            $contacts_model_update->name = filter_input(INPUT_POST, 'name');
            $contacts_model_update->person_type = filter_input(INPUT_POST, 'person_type');
            $contacts_model_update->cell_phone = filter_input(INPUT_POST, 'cellphone');
            $contacts_model_update->phone = filter_input(INPUT_POST, 'phone');
            $contacts_model_update->email = filter_input(INPUT_POST, 'email');
            $contacts_model_update->address = filter_input(INPUT_POST, 'address');            
            if ($contacts_model_update->validate()) {
                $contacts_model_update->save();
                return json_encode(true);
            } else {
                return json_encode($contacts_model_update->getErrors());
            }
        }
    }
    
}
