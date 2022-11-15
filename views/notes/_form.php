<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notes-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fk_users')->textInput() ?>

    <?= $form->field($model, 'fk_supplier')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'public')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
