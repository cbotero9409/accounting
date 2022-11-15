<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaxesconfigurationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxesconfiguration-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'iva') ?>

    <?= $form->field($model, 'retention') ?>

    <?= $form->field($model, 'rete_ica') ?>

    <?= $form->field($model, 'tax_cree') ?>

    <?php // echo $form->field($model, 'auto_retention') ?>

    <?php // echo $form->field($model, 'other') ?>

    <?php // echo $form->field($model, 'other_2') ?>

    <?php // echo $form->field($model, 'fk_chart_account') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
