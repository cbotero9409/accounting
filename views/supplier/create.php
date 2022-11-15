<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supplier */

$this->title = 'Agregar proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'supplier_type' => $supplier_type,
    ]) ?>

</div>
