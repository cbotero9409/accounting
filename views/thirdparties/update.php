<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Thirdparties */

$this->title = 'Modificar Tercero: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="thirdparties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'doc_type' => $doc_type,
        'contact_model' => $contact_model,
        'munic' => $munic,
        'depts' => $depts,
        'banks' => $banks,
        'account_type' => $account_type,
        'tax_clasif_model' => $tax_clasif_model,
        'economic_activity' => $economic_activity,
        'tax_profiles' => $tax_profiles,
        'option_items' => $option_items,
        'files_array' => $files_array,
        'files_model' => $files_model,
        'files_name' => $files_name,
        'all_lines' => $all_lines,
        'all_items' => $all_items,
        'all_purchased' => $all_purchased,
    ])
    ?>

</div>
