<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = $model->id . ' - ' . $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar esta empresa?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>


    <?php
    if ($logo) {
        echo "<div class='mb-2'>";
        echo Html::img("../img/company/$logo", ['height' => '100px']);
        echo "</div>";
    }
    ?>


    <span class="h5 mt-2">General</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
//            'id',
//            'business_name',
//            'doc_type',
            'doc_number',
//            'dv',
//            'short_name',
            'manager',
//            'color',
            'legal_representative',
//            'representative_doc',
            'accountant',
//            'accountant_doc',
            'tax_auditor',
//            'auditor_doc',
//            'e_billing_management',
//            'doc_platform',
//            'own_email_sender:email',
            'fk_municipality',
            'address',
//            'cxc_term',
//            'cxp_term',
//            'interest_management',
//            'electronic_billing:ntext',
//            'start_date',
//            'end_date',
        ],
    ])
    ?>


    <?php
    if ($contacts_model) {
        echo "<span class='h5 mt-2'>Contacto</span>";
        echo DetailView::widget([
            'model' => $contacts_model,
            'template' => function ($attribute, $index, $widget) {
                //your code for rendering here. e.g.
                if ($attribute['value']) {
                    return "<tr><th>{$attribute['label']}</th><td>{$attribute['value']}</td></tr>";
                }
            },
            'attributes' => [
//            'id',
                'name',
                'person_type',
                'cell_phone',
                'phone',
                'email:email',
                'address',
            ],
        ]);
    }
    ?>
    <div>
        <span class="h5 text">Sedes</span>
        <?=
        GridView::widget([
            'dataProvider' => $data_hq,
            'filterModel' => $search_hq,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'fk_company',
                'code',
                'name',
//            'short_name',
                //'manager',
                //'fk_municipality',
                //'address',
                //'default_category',
                //'cost_center_class',
                //'group_class',
                //'start_date',
                //'end_date',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {create2}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a("<i class='fas fa-eye'></i>", ['headquarters/view', 'id' => $model->id], ['title' => Yii::t('yii', 'Ver Sede')]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a("<i class='fas fa-pencil-alt'></i>", ['headquarters/update', 'id' => $model->id], ['title' => Yii::t('yii', 'Modificar Sede')]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a("<i class='fas fa-trash-alt'></i>", ['headquarters/delete', 'id' => $model->id], ['title' => Yii::t('yii', 'Eliminar Sede')]);
                        },
                        'create2' => function ($url, $model) {
                            return Html::a("<i class='fas fa-cash-register ml-1'></i>", ['costcenter/create', 'id_company' => $model->fk_company, 'id_headquarter' => $model->id], ['title' => Yii::t('yii', 'Agregar Centro de Costo')]);
                        }
                    ],
                ]
            ],
        ]);
        echo Html::a("+ Agregar Sede", ['headquarters/create', 'id_company' => $model->id], ['class' => 'btn btn-primary']);
        ?>   
    </div>

    <div class="mt-3">
        <span class="h5 text">Centros de Costos</span>
        <?=
        GridView::widget([
            'dataProvider' => $data_cc,
            'filterModel' => $search_cc,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'id',
                'code',
                'name',
//            'short_name',
//            'manager',
                //'class_cc',
                //'group_class',
                //'start_date',
                //'end_date',
//                'fk_company',
//                'fk_headquarter',
//                'fk_cost_center',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {create2}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a("<i class='fas fa-eye'></i>", ['costcenter/view', 'id' => $model->id], ['title' => Yii::t('yii', 'Ver Sede')]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a("<i class='fas fa-pencil-alt'></i>", ['costcenter/update', 'id' => $model->id], ['title' => Yii::t('yii', 'Modificar Sede')]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a("<i class='fas fa-trash-alt'></i>", ['costcenter/delete', 'id' => $model->id], ['title' => Yii::t('yii', 'Eliminar Sede')]);
                        },
                        'create2' => function ($url, $model) {
                            if (strlen($model->code) <= 5) {
                                return Html::a("<i class='fas fa-cash-register ml-1'></i>", ['costcenter/create', 'id_company' => $model->fk_company, 'id_cost_center' => $model->id], ['title' => Yii::t('yii', 'Agregar Centro de Costo')]);
                            }
                        }
                    ],
                ]
            ],
        ]);
        echo Html::a("+ Agregar Centro de Costos", ['costcenter/create', 'id_company' => $model->id], ['class' => 'btn btn-primary']);
        ?>
    </div>
</div>
