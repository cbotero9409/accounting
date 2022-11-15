<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Costcenter */

$this->title = $model->code.' - '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->fkCompany->business_name, 'url' => ['company/view', 'id' => $model->fk_company]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="costcenter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
//            'id',
//            'code',
//            'name',
            'short_name',
            'manager',
            'class_cc',
            'group_class',
            'start_date',
            'end_date',
            'fk_company',
            'fk_headquarter',
            'fk_cost_center',
        ],
    ]) ?>
    
    <?php if (strlen($model->code) <= 5) { ?>
                                
       <div class="mt-3">
        <span class="h5 text">Centros de Costos Asociados</span>
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
        echo Html::a("+ Agregar Centro de Costos", ['costcenter/create', 'id_company' => $model->fk_company, 'id_headquarter' => $model->fk_headquarter, 'id_cost_center' => $model->id], ['class' => 'btn btn-primary']);
        ?>
    </div>
    <?php } ?>

</div>
