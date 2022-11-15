<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Expenselist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenselist-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'fk_chart_account')->widget(Select2::classname(), [
        'data' => $accounts,
        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'concept')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>
    
    <?=
    $form->field($model, 'fk_cost_center')->widget(Select2::classname(), [
        'data' => $centers,
        'options' => ['placeholder' => 'Seleccionar Centro...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?php
//    echo $form->field($model, 'fk_invoice')->widget(Select2::classname(), [
//        'data' => $invoices,
//        'options' => ['placeholder' => 'Seleccionar Centro...'],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]);
    ?>
    
    <?= $form->field($model, 'fk_inovice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
