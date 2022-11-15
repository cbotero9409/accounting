<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documenttype */

$this->title = 'Agregar Tipo de Documento';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Documento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documenttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'num_type' => $num_type,
    ]) ?>

</div>
