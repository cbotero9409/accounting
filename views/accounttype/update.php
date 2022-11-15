<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accounttype */

$this->title = 'Modificar Tipo de Cuenta: ' . $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Cuenta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="accounttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
