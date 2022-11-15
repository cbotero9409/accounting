<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productslines */

$this->title = 'Create Productslines';
$this->params['breadcrumbs'][] = ['label' => 'Productslines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productslines-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
