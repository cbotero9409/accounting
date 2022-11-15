<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Headquarters */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->fkCompany->business_name, 'url' => ['company/view', 'id' => $model->fk_company]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="headquarters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar esta sede?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <span class="font-weight-bold h5">Información General</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            [
                'attribute' => 'fk_company',
                'value' => $model->fkCompany->business_name,
            ],
            'code',
            'name',
            'short_name',
            'manager',
        ],
    ])
    ?>


    <?php
    if ($contacts_model) {
        echo "<span class='font-weight-bold h5'>Datos de Contacto</span>";
        echo DetailView::widget([
            'model' => $contacts_model,
            'attributes' => [
                'name',
                'person_type',
                'cell_phone',
                'phone',
                'email',
            ],
        ]);
    }
    ?>

    <span class="font-weight-bold h5">Dirección</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fk_municipality',
            'address',
        ],
    ])
    ?>

    <span class="font-weight-bold h5">Clasificadores</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cost_center_class',
            'group_class',
        ],
    ])
    ?>

    <span class="font-weight-bold h5">Vigencia</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'start_date',
            'end_date',
        ],
    ])
    ?>

    <span class="font-weight-bold h5">Categorías</span>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'default_category',
        ],
    ])
    ?>
    <table class="table table-striped table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">Cód. CC</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre Corto</th>
                <th scope="col">Tipo</th>
                <th scope="col">Responsable</th>
                <th scope="col">Imágen</th>
            </tr>
        </thead>
        <tbody id="table_cat_body">                        
            <?php
            foreach ($all_categories as $category) {
                print "<tr>
                                        <td>$category->cod_cc</td>
                                        <td>$category->name</td>
                                        <td>$category->short_name</td>
                                        <td>$category->type</td>
                                        <td>$category->manager</td>
                                        <td>$category->image</td>
                                    </tr>";
            }
            ?>
        </tbody>
    </table>

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
                                return Html::a("<i class='fas fa-cash-register ml-1'></i>", ['costcenter/create', 'id_company' => $model->fk_company, 'id_headquarter' => $model->fk_headquarter, 'id_cost_center' => $model->id], ['title' => Yii::t('yii', 'Agregar Centro de Costo')]);
                            }
                        }
                    ],
                ]
            ],
        ]);
        echo Html::a("+ Agregar Centro de Costos", ['costcenter/create', 'id_company' => $model->fk_company, 'id_headquarter' => $model->id], ['class' => 'btn btn-primary']);
        ?>
    </div>
</div>
