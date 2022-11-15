<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">Agregar Contacto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="contacts-form">

        <?php $form_contacts = ActiveForm::begin(['id' => 'form_create_contact']); ?>

        <?= $form_contacts->field($contacts_model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form_contacts->field($contacts_model, 'person_type')->dropDownList(["Natural" => "Natural", "Jurídica" => "Jurídica"], ['prompt' => 'Seleccionar Tipo de Persona']) ?>

        <?= $form_contacts->field($contacts_model, 'cell_phone')->textInput(['maxlength' => true]) ?>

        <?= $form_contacts->field($contacts_model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form_contacts->field($contacts_model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form_contacts->field($contacts_model, 'address')->textInput(['maxlength' => true]) ?>         
        
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <div class="form-group">
        <?= Html::button('Guardar', ['class' => 'btn btn-primary', 'onclick'=>"createContact()"]); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
