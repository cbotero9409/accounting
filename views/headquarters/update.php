<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Headquarters */

$this->title = 'Modificar Sede: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['company/index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="headquarters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'contacts_model' => $contacts_model,
        'munic' => $munic,
        'depts' => $depts,
        'class_cc' => $class_cc,
        'categories' => $categories,
        'all_categories' => $all_categories,
    ])
    ?>

</div>
