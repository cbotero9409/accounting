<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Costcenter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="costcenter-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_company')->textInput(['disabled' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre..']) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre Corto..']) ?>

    <?= $form->field($model, 'manager')->textInput(['maxlength' => true, 'placeholder' => 'Responsable..']) ?>

    <?= $form->field($model, 'class_cc')->dropDownList($class_cc, ['prompt' => 'Seleccionar Clase..']) ?>

    <?= $form->field($model, 'group_class')->textInput(['maxlength' => true, 'placeholder' => 'Grupo..']) ?>

    <?=
    $form->field($model, 'start_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Inicio de Vigencia..'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'end_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Fin de Vigencia..'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
