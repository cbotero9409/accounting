<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxes */

$this->title = 'Modificar Impuesto: ' . $model->tax;
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tax, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="taxes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'type' => $type,
    ])
    ?>

</div>
