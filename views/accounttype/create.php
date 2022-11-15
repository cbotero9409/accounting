<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accounttype */

$this->title = 'Crear Tipo de Cuenta';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Cuenta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
