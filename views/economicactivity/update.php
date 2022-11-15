<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Economicactivity */

$this->title = 'Update Economicactivity: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Economicactivities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="economicactivity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
