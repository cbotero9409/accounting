<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Headquarters */

$this->title = 'Agregar Sede';
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['company/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="headquarters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contacts_model' => $contacts_model,
        'depts' => $depts,
        'munic' => $munic,
        'class_cc' => $class_cc,
        'categories' => $categories,
    ]) ?>

</div>
