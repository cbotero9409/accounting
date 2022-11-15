<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesliquidation */

$this->title = 'Modificar Concepto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Liquidación de Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="taxesliquidation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
        //        'invoices' => $invoices,
    ]) ?>

</div>
