<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">Modificar Contacto</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="contacts-form">

        <?php $form_update_contacts = ActiveForm::begin(['id' => 'form_update_contact']); ?>

        <?= $form_update_contacts->field($contacts_model_update, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form_update_contacts->field($contacts_model_update, 'person_type')->dropDownList(["Natural" => "Natural", "Jurídica" => "Jurídica"], ['prompt' => 'Seleccionar Tipo de Persona']) ?>

        <?= $form_update_contacts->field($contacts_model_update, 'cell_phone')->textInput(['maxlength' => true]) ?>

        <?= $form_update_contacts->field($contacts_model_update, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form_update_contacts->field($contacts_model_update, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form_update_contacts->field($contacts_model_update, 'address')->textInput(['maxlength' => true]) ?> 
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <div class="form-group">
        <?= Html::button('Guardar', ['class' => 'btn btn-primary', 'onclick'=>"updateContact('$contacts_model_update->id')"]); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
