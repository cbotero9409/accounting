<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Billofsale */

$this->title = 'Modificar factura: ' . $model->doc_number;
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="billofsale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'doc_type' => $doc_type,
        'classes' => $classes,
        'depts' => $depts,
        'munic' => $munic,
        'cost_center' => $cost_center,
        'accounts' => $accounts,
        'retentions' => $retentions,
        'bank_model' => $bank_model,
        'mov_type' => $mov_type,
        'bills_model' => $bills_model,
        'type_operation' => $type_operation,
        'all_income_list' => $all_income_list,
        'all_taxes_list' => $all_taxes_list,
        'files_array' => $files_array,
        'uploads_model' => $uploads_model,
        'files_name' => $files_name,
    ])
    ?>

</div>
