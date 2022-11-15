<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Billtopay */

$this->title = 'Update Billtopay: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Billtopays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="billtopay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
    ]) ?>

</div>
