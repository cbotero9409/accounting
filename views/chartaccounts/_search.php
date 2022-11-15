<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChartaccountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chartaccounts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'account') ?>

    <?= $form->field($model, 'handle_third_parties') ?>

    <?= $form->field($model, 'controls_indebtedness') ?>

    <?php // echo $form->field($model, 'handle_references') ?>

    <?php // echo $form->field($model, 'discriminate_by_third_party') ?>

    <?php // echo $form->field($model, 'demands_base_value') ?>

    <?php // echo $form->field($model, 'visible_in_selection') ?>

    <?php // echo $form->field($model, 'local_account') ?>

    <?php // echo $form->field($model, 'niif_account') ?>

    <?php // echo $form->field($model, 'fk_account') ?>

    <?php // echo $form->field($model, 'use_niif_equivalent_account') ?>

    <?php // echo $form->field($model, 'fk_account_type') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'fk_tax') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
