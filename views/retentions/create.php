<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Retentions */

$this->title = 'Agregar Retención';
$this->params['breadcrumbs'][] = ['label' => 'Retenciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retentions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
        'cal_type' => $cal_type,
        'mov_type' => $mov_type,
        'accounts' => $accounts,
        'payment_table' => $payment_table,
        'third_id' => $third_id,
        'cost_center' => $cost_center,
        'how_affects' => $how_affects,
    ]) ?>

</div>
