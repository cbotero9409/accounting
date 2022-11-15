<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BilltopaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billtopay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'third_party') ?>

    <?= $form->field($model, 'account') ?>

    <?= $form->field($model, 'date_to_pay') ?>

    <?= $form->field($model, 'number_of_fees') ?>

    <?php // echo $form->field($model, 'fk_inovice') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
