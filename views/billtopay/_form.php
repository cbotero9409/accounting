<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Billtopay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billtopay-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'third_party')->widget(Select2::classname(), [
        'data' => $accounts,
        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'account')->widget(Select2::classname(), [
        'data' => $accounts,
        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'date_to_pay')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Fecha de Pago ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'number_of_fees')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'fk_inovice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
