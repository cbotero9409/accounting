<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Billtopay */

$this->title = 'Agregar Cuenta';
$this->params['breadcrumbs'][] = ['label' => 'Cuentas por Pagar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billtopay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
    ]) ?>

</div>
