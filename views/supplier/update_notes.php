<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="modal-header">
    <h5 class="modal-title" id="notesModalLabel">Modificar Nota</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <?php $form_notes_update = ActiveForm::begin(['id' => 'form_update_note']); ?>

    <?= $form_notes_update->field($notes_model_update, 'note')->textarea(['rows' => 4])->label('Nota') ?>

<?= $form_notes_update->field($notes_model_update, 'public')->dropDownList([0 => "Privada", 1 => "Pública"]) ?>                         
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <div class="form-group">
    <?= Html::button('Guardar', ['class' => 'btn btn-primary', 'onclick' => "updateNote('$notes_model_update->id', '$notes_model_update->date')"]); ?>
    </div>
<?php ActiveForm::end(); ?>
</div>

