<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Thirdparties */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="thirdparties-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?php
    if (isset($model->photo)) {
        echo yii\bootstrap4\Html::img("../img/third_parties/$model->photo", ['class' => 'img-fluid', 'width' => '300']);
    }
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'code',
            'dv',
            'doc_type',
            'name',
            'tradename',
//            'visible',
//            'juridical',
//            'branch_office',
//            'photo',
            'supplier:boolean',
            'client:boolean',
            'employee:boolean',
            'seller:boolean',
            'interested:boolean',
            'associate:boolean',
//            'treatment',
            'profession',
            'company',
            'appointment',
//            'genre',
//            'birthday',
//            'quick_code',
//            'processing_personal_data',
//            'transactional_info',
//            'promotional_info',
            'fk_municipality',
            'address',
//            'standard_supplier',
//            'payroll_entity_supplier',
//            'block_payments',
//            'payment_deadline',
//            'account_holder',
//            'account_number',
//            'account_bank',
//            'account_type',
//            'account_payment_method',
//            'alternate_code',
//            'class',
            'additional_notes:ntext',
//            'fk_third',
        ],
    ])
    ?>


    <?php
    if (!empty($contact_model)) {
        echo "<span class='mt-2 h5'>Contacto</span>";
        echo DetailView::widget([
            'model' => $contact_model,
            'attributes' => [
                'cell_phone',
                'phone',
                'email:email',
                'web_page',
            ],
        ]);
    }
    ?>
    <?php if (!empty($files_model)) { ?>
        <span class="mt-2 h5">Archivos Adjuntos</span> 
        <table class="table table-striped table-bordered detail-view">        
            <tbody>                
                <?php
                foreach ($files_model as $uploaded_file) {
                    echo '<tr><td>';
                    echo Html::a($uploaded_file->file, ["uploads/third_parties/$uploaded_file->file"], ['target' => '_blank']);
                    echo '</td></tr>';
                }
                ?>                    
            </tbody>
        </table>
    <?php } ?>

        <div class="mt-3">
        <span class="h5 text">Surcursales</span>
<?=
    GridView::widget([
        'dataProvider' => $data_branches,
        'filterModel' => $search_branches,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                ],
        ],
    ]);
    echo Html::a("+ Agregar Sucursal", ['create', 'id' => $model->id], ['class' => 'btn btn-primary']);
    ?>

        </div>

</div>

