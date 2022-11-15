<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenselistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenselist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_chart_account') ?>

    <?= $form->field($model, 'concept') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'fk_cost_center') ?>

    <?php // echo $form->field($model, 'fk_inovice') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
