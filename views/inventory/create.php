<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventory */

$this->title = 'Create Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
