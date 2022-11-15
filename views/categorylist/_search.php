<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategorylistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorylist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cod_cc') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'short_name') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'manager') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'fk_headquarter') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
