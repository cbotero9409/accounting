<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-header">
    <h5 class="modal-title" id="notesModalLabel">Nota Nueva</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <?php $form_notes = ActiveForm::begin(['id' => 'form_create_note']); ?>

    <?= $form_notes->field($notes_model, 'note')->textarea(['rows' => 4])->label('Nota') ?>

    <?= $form_notes->field($notes_model, 'public')->dropDownList([0 => "Privada", 1 => "Pública"]) ?>                        
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <div class="form-group">
        <?= Html::button('Guardar', ['class' => 'btn btn-primary', 'onclick'=>"createNote()"]); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>