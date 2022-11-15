<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */

$this->title = 'Agregar Contacto';
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'suppliers' => $suppliers
    ]) ?>

</div>
