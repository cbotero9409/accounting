<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesliquidation */

$this->title = 'Agregar Concepto';
$this->params['breadcrumbs'][] = ['label' => 'Liquidación de Impúestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxesliquidation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
//        'invoices' => $invoices,
    ]) ?>

</div>
