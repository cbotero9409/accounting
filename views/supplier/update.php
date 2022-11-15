<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = 'Modificar Proveedor: ' . $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="supplier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'supplier_type' => $supplier_type,
    ])
    ?>

</div>
