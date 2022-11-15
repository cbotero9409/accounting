<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RetentionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="retentions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_parent_retention') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'validity_start') ?>

    <?php // echo $form->field($model, 'calculation_type') ?>

    <?php // echo $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'min_base_value') ?>

    <?php // echo $form->field($model, 'auto_calculation') ?>

    <?php // echo $form->field($model, 'movement_type') ?>

    <?php // echo $form->field($model, 'bill_to_pay') ?>

    <?php // echo $form->field($model, 'how_affects') ?>

    <?php // echo $form->field($model, 'payment_date_table') ?>

    <?php // echo $form->field($model, 'third_party_alias') ?>

    <?php // echo $form->field($model, 'expense_account') ?>

    <?php // echo $form->field($model, 'cost_center') ?>

    <?php // echo $form->field($model, 'obsolete') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
