<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaxesliquidationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxesliquidation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'concept') ?>

    <?= $form->field($model, 'base_value') ?>

    <?= $form->field($model, 'observation') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'account_to_affect') ?>

    <?php // echo $form->field($model, 'third_party') ?>

    <?php // echo $form->field($model, 'cc_active') ?>

    <?php // echo $form->field($model, 'payment_date') ?>

    <?php // echo $form->field($model, 'fk_invoice') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
