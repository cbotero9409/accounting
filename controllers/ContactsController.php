<?php

namespace app\controllers;

use app\models\Contacts;
use app\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
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
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $supplier = \app\models\Supplier::find()->select(['business_name'])->where(['id' => $model->fk_supplier])->one();
        $supp = $supplier->business_name;
        return $this->render('view', [
            'model' => $model,
            'supplier' => $supp,
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacts();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        $option_suppliers = array();
        $suppliers = \app\models\Supplier::find()->select(['id', 'business_name'])->all();
        foreach ($suppliers as $supplier) {
            $option_suppliers[$supplier->id] = $supplier->business_name;
        }

        return $this->render('create', [
            'model' => $model,
            'suppliers' => $option_suppliers
        ]);
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $option_suppliers = array();
        $suppliers = \app\models\Supplier::find()->select(['id', 'business_name'])->all();
        foreach ($suppliers as $supplier) {
            $option_suppliers[$supplier->id] = $supplier->business_name;
        }

        return $this->render('update', [
            'model' => $model,
            'suppliers' => $option_suppliers
        ]);
    }

    /**
     * Deletes an existing Contacts model.
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
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

