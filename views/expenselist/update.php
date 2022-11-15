<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expenselist */

$this->title = 'Update Expenselist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expenselists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expenselist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'centers' => $centers,
//        'invoices' => $invoices,
    ]) ?>

</div>
