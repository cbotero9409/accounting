<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesconfiguration */

$this->title = 'Agregar Configuración';
$this->params['breadcrumbs'][] = ['label' => 'Configuración de Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxesconfiguration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'retentions' => $retentions,
    ]) ?>

</div>
