<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventoryitems */

$this->title = 'Create Inventoryitems';
$this->params['breadcrumbs'][] = ['label' => 'Inventoryitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventoryitems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
