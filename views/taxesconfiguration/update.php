<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesconfiguration */

$this->title = 'Modificar Configuración de Impuesto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configuración de Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="taxesconfiguration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
    ]) ?>

</div>
