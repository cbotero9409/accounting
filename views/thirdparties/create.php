<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Thirdparties */
if (!isset($model->fk_third)) {
    $this->title = 'Agregar Tercero';
} else {
    $this->title = 'Agregar Sucursal';
}
$this->params['breadcrumbs'][] = ['label' => 'Terceros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thirdparties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'doc_type' => $doc_type,
        'contact_model' => $contact_model,
        'munic' => $munic,
        'depts' => $depts,
        'tax_clasif_model' => $tax_clasif_model,
        'economic_activity' => $economic_activity,
        'tax_profiles' => $tax_profiles,
        'option_items' => $option_items,
        'banks' => $banks,
        'account_type' => $account_type,
        'files_model' => $files_model,
        'files_array' => $files_array,
    ])
    ?>

</div>
