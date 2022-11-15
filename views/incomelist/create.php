<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Incomelist */

$this->title = 'Create Incomelist';
$this->params['breadcrumbs'][] = ['label' => 'Incomelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomelist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
