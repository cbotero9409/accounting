<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cashbank */

$this->title = 'Agregar Transacción';
$this->params['breadcrumbs'][] = ['label' => 'Transacción Banco', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'mov_type' => $mov_type,
    ]) ?>

</div>
