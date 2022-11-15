<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Payrolltaxes */

$this->title = 'Update Payrolltaxes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payrolltaxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payrolltaxes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
    ]) ?>

</div>
