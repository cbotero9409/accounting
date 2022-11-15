<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/createUsersForm.js');

?>

<div class="users-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableAjaxValidation' => true, 'validationUrl' => ['ajax-validation']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'document')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'birthday')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Fecha de Nacimiento ...'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label for="dept_form">Departamento</label>
        <select class="form-control" id="dept_form" onchange="deptsFunction(this.value)">
            <option>Seleccionar Departamento</option>
            <?= $depts; ?>
        </select>
    </div>   

    <?= $form->field($model, 'fk_municipality')->dropDownList($munic, ['prompt' => 'Seleccionar Municipio']) ?>

    <?= $form->field($model, 'gender')->dropDownList($gender, ['prompt' => 'Seleccionar Género']) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type')->dropDownList($user_type, ['prompt' => 'Seleccionar Tipo de Usuario']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if($model->password == '') {
        echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
    }  ?>

    <?php
    if ($model->photo !== NULL) {
        echo $form->field($model, 'imageFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => [
                    "../img/$model->photo"
                ],
                'initialPreviewAsData' => true,
                'initialPreviewConfig' => [
                    ['caption' => "$model->photo"]
        ]]]);
    } else {
        echo $form->field($model, 'imageFile')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*']]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
