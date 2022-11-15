<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documenttype */

$this->title = 'Modificar: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de documento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="documenttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'num_type' => $num_type,
    ]) ?>

</div>
