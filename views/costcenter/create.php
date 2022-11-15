<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Costcenter */

$this->title = 'Agregar Centro de Costo';
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['company/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costcenter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class_cc' => $class_cc,
    ]) ?>

</div>
