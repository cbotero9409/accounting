<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesliquidation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxesliquidation-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'concept')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar Concepto...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'base_value')->textInput() ?>

    <?= $form->field($model, 'observation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'account_to_affect')->textInput() ?>

    <?= $form->field($model, 'third_party')->textInput() ?>

    <?= $form->field($model, 'cc_active')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'payment_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Fecha de Pago ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'fk_invoice')->textInput() ?>

    <?php
//    echo $form->field($model, 'fk_invoice')->widget(Select2::classname(), [
//        'data' => $invoices,
//        'options' => ['placeholder' => 'Seleccionar Centro...'],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
