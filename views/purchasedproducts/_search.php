<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PurchasedproductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchasedproducts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'unit') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'doc_number') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'movement_type') ?>

    <?php // echo $form->field($model, 'fk_third') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
