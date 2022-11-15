<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clasification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'construction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_price')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'data_sheet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_company')->textInput() ?>

    <?= $form->field($model, 'fk_type')->textInput() ?>

    <?= $form->field($model, 'fk_municipality')->textInput() ?>

    <?= $form->field($model, 'fk_tax')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
