<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'reference') ?>

    <?= $form->field($model, 'clasification') ?>

    <?= $form->field($model, 'construction') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'unit_price') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'data_sheet') ?>

    <?php // echo $form->field($model, 'fk_company') ?>

    <?php // echo $form->field($model, 'fk_type') ?>

    <?php // echo $form->field($model, 'fk_municipality') ?>

    <?php // echo $form->field($model, 'fk_tax') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
