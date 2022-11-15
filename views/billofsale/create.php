<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Billofsale */

$this->title = 'Agregar Factura';
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billofsale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
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
        'uploads_model' => $uploads_model,
        'files_array' => $files_array,
    ]) ?>

</div>
