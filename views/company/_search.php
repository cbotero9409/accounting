<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'business_name') ?>

    <?= $form->field($model, 'doc_type') ?>

    <?= $form->field($model, 'doc_number') ?>

    <?= $form->field($model, 'dv') ?>

    <?php // echo $form->field($model, 'short_name') ?>

    <?php // echo $form->field($model, 'manager') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'legal_representative') ?>

    <?php // echo $form->field($model, 'representative_doc') ?>

    <?php // echo $form->field($model, 'accountant') ?>

    <?php // echo $form->field($model, 'accountant_doc') ?>

    <?php // echo $form->field($model, 'tax_auditor') ?>

    <?php // echo $form->field($model, 'auditor_doc') ?>

    <?php // echo $form->field($model, 'e_billing_management') ?>

    <?php // echo $form->field($model, 'doc_platform') ?>

    <?php // echo $form->field($model, 'own_email_sender') ?>

    <?php // echo $form->field($model, 'fk_municipality') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'cxc_term') ?>

    <?php // echo $form->field($model, 'cxp_term') ?>

    <?php // echo $form->field($model, 'interest_management') ?>

    <?php // echo $form->field($model, 'electronic_billing') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
