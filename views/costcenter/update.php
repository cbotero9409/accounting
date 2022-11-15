<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Costcenter */

$this->title = 'Modificar Centro de Costo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['company/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="costcenter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class_cc' => $class_cc,
    ]) ?>

</div>
