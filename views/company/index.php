<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Empresa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <span class="h5 text">Empresas</span>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'business_name',
//            'doc_type',
//            'doc_number',
//            'dv',
            //'short_name',
            //'manager',
            //'color',
            //'legal_representative',
            //'representative_doc',
            //'accountant',
            //'accountant_doc',
            //'tax_auditor',
            //'auditor_doc',
            //'e_billing_management',
            //'doc_platform',
            //'own_email_sender:email',
            //'fk_municipality',
            //'address',
            //'cxc_term',
            //'cxp_term',
            //'interest_management',
            //'electronic_billing:ntext',
            //'start_date',
            //'end_date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {create} {create2}',
                'buttons' => [
                    'create' => function ($url, $model) {
                        return Html::a("<i class='fas fa-warehouse ml-1'></i>", ['headquarters/create', 'id_company' => $model->id], ['title' => Yii::t('yii', 'Agregar Sede')]);
                    },
                    'create2' => function ($url, $model) {
                        return Html::a("<i class='fas fa-cash-register ml-1'></i>", ['costcenter/create', 'id_company' => $model->id], ['title' => Yii::t('yii', 'Agregar Centro de Costo')]);
                    }
                ],
            ]
        ],
    ]);
    ?>

   
</div>


