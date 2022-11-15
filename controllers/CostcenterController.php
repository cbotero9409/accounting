<?php

namespace app\controllers;

use app\models\Costcenter;
use app\models\CostcenterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CostcenterController implements the CRUD actions for Costcenter model.
 */
class CostcenterController extends Controller {

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
     * Lists all Costcenter models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CostcenterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Costcenter model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $model->fk_company = $model->fkCompany->id . ' - ' . $model->fkCompany->business_name;
        $model->fk_headquarter ? $model->fk_headquarter = $model->fkHeadquarter->code . ' - ' . $model->fkHeadquarter->name : print '';
        $model->fk_cost_center ? $model->fk_cost_center = $model->fkCostCenter->code . ' - ' . $model->fkCostCenter->name : print '';

        $search_cc = new \app\models\CostcenterSearch();
        $data_cc = $search_cc->search($this->request->queryParams);
        $data_cc->query->andWhere(['fk_company' => $model->fk_company, 'fk_cost_center' => $id]);
        
        $model->class_cc = \Yii::$app->params['hq']['class_cc'][$model->class_cc];

        return $this->render('view', [
                    'model' => $model,
                    'search_cc' => $search_cc,
                    'data_cc' => $data_cc,
        ]);
    }

    /**
     * Creates a new Costcenter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_company = null, $id_headquarter = null, $id_cost_center = null) {
        $model = new Costcenter();
        $model_company = \app\models\Company::findOne($id_company);
        $model->fk_company = "$model_company->id - $model_company->business_name";

        if ($id_cost_center) {
            $max_cc = Costcenter::find()->select('code')->from('cost_center')->where(['fk_cost_center' => $id_cost_center])->max('code');
            $model_cc = Costcenter::findOne($id_cost_center);
            if ($max_cc) {
                $model->code = strval(intval($max_cc) + 1);
            } else {
                $model->code = strval($model_cc->code * 1000 + 1);
            }
        } else if ($id_headquarter) {
            $max_cc = Costcenter::find()->select('code')->from('cost_center')->where(['fk_headquarter' => $id_headquarter])->max('code');
            $model_hq = \app\models\Headquarters::findOne($id_headquarter);
            if ($max_cc) {
                $model->code = strval(intval($max_cc) + 1);
            } else {
                $model->code = strval($model_hq->fk_company * 1000 + $model_hq->code * 100 + 1);
            }
        } else {
            $max_cc = Costcenter::find()->select('code')->from('cost_center')->where(['fk_company' => $id_company])->max('code');
            if ($max_cc) {
                $model->code = strval(intval($max_cc) + 1);
            } else {
                $model->code = strval($id_company * 100000 + 1);
            }
        }

        $class_cc = \Yii::$app->params['hq']['class_cc'];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->fk_company = $model_company->id;
                $model->fk_headquarter = $id_headquarter;
                $model->fk_cost_center = $id_cost_center;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
                    'class_cc' => $class_cc,
        ]);
    }

    /**
     * Updates an existing Costcenter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $class_cc = \Yii::$app->params['hq']['class_cc'];        

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'class_cc' => $class_cc,
        ]);
    }

    /**
     * Deletes an existing Costcenter model.
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
     * Finds the Costcenter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Costcenter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Costcenter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
