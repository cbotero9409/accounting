<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Company */

$this->title = 'Agregar Empresa';
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'doc_type' => $doc_type,
        'contacts_model' => $contacts_model,
        'munic' => $munic,
        'depts' => $depts,
        'tax_clasif_model' => $tax_clasif_model,
        'economic_activity' => $economic_activity,
        'tax_profile' => $tax_profile,
        'label_model' => $label_model,
        'header_type' => $header_type,
        'colors' => $colors,
    ])
    ?>

</div>
