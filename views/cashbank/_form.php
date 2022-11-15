<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Cashbank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cashbank-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'bank_account')->widget(Select2::classname(), [
        'data' => $accounts,
        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'movement_type')->widget(Select2::classname(), [
        'data' => $mov_type,
        'options' => ['placeholder' => 'Seleccionar Tipo...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Fecha de transacción ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'fk_invoice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
