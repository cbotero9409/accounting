<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payrolltaxes */

$this->title = 'Agregar Impuesto de Nómina';
$this->params['breadcrumbs'][] = ['label' => 'Impuestos de Nómina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payrolltaxes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
    ]) ?>

</div>
