<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incomelist */

$this->title = 'Update Incomelist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Incomelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="incomelist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
