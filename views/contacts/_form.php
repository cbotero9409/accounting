<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mt-4">

    <?php $form = ActiveForm::begin(); ?>    
    
    <?=
    $form->field($model, 'fk_supplier')->widget(Select2::classname(), [
        'data' => $suppliers,
        'options' => ['placeholder' => 'Seleccionar cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'person_type')->dropDownList(["Natural" => "Natural", "Jurídica" => "Jurídica"], ['prompt' => 'Seleccionar Tipo de Persona']) ?>

    <?= $form->field($model, 'cell_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>   

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
