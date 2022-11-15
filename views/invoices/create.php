<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */

$this->title = 'Agregar Factura';
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Compra', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-create">

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
    ]) ?>

</div>
