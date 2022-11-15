<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ThirdpartiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thirdparties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'dv') ?>

    <?= $form->field($model, 'doc_type') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'tradename') ?>

    <?php // echo $form->field($model, 'visible') ?>

    <?php // echo $form->field($model, 'juridical') ?>

    <?php // echo $form->field($model, 'branch_office') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'supplier') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'employee') ?>

    <?php // echo $form->field($model, 'seller') ?>

    <?php // echo $form->field($model, 'interested') ?>

    <?php // echo $form->field($model, 'associate') ?>

    <?php // echo $form->field($model, 'treatment') ?>

    <?php // echo $form->field($model, 'profession') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'appointment') ?>

    <?php // echo $form->field($model, 'genre') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'quick_code') ?>

    <?php // echo $form->field($model, 'processing_personal_data') ?>

    <?php // echo $form->field($model, 'transactional_info') ?>

    <?php // echo $form->field($model, 'promotional_info') ?>

    <?php // echo $form->field($model, 'fk_municipality') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'standard_supplier') ?>

    <?php // echo $form->field($model, 'payroll_entity_supplier') ?>

    <?php // echo $form->field($model, 'block_payments') ?>

    <?php // echo $form->field($model, 'payment_deadline') ?>

    <?php // echo $form->field($model, 'account_holder') ?>

    <?php // echo $form->field($model, 'account_number') ?>

    <?php // echo $form->field($model, 'account_bank') ?>

    <?php // echo $form->field($model, 'account_type') ?>

    <?php // echo $form->field($model, 'account_payment_method') ?>

    <?php // echo $form->field($model, 'alternate_code') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'additional_notes') ?>

    <?php // echo $form->field($model, 'fk_third') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
