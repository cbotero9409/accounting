<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cashbank */

$this->title = 'Update Cashbank: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cashbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashbank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'mov_type' => $mov_type,
    ]) ?>

</div>
