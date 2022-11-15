<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

$this->title = 'Modificar Factura: ' . $model->doc_number;
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Compra', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->doc_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="invoices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'doc_type' => $doc_type,
        'classes' => $classes,
        'depts' => $depts,
        'munic' => $munic,
        'accounts' => $accounts,
        'cost_center' => $cost_center,
        'retentions' => $retentions,
        'bank_model' => $bank_model,
        'mov_type' => $mov_type,
        'bills_model' => $bills_model,
        'all_expense_list' => $all_expense_list,
        'all_taxes_list' => $all_taxes_list,
    ]) ?>

</div>
