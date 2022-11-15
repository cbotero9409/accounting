<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invoices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_doc_type') ?>

    <?= $form->field($model, 'doc_number') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'fk_municipality') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'cost_center') ?>

    <?php // echo $form->field($model, 'third_party') ?>

    <?php // echo $form->field($model, 'reference') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'cash') ?>

    <?php // echo $form->field($model, 'account_cash') ?>

    <?php // echo $form->field($model, 'cash_payment_bank') ?>

    <?php // echo $form->field($model, 'bill_to_pay') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
