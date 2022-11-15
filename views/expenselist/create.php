<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenselist */

$this->title = 'Agregar Gasto';
$this->params['breadcrumbs'][] = ['label' => 'Lista de Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenselist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'centers' => $centers,
//        'invoices' => $invoices,
    ]) ?>

</div>
