<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Modificar Contraseña: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="users-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

        <?php $form_pass = ActiveForm::begin(['enableClientValidation' => true], ['clientOptions' => ['validateOnSubmit' => true]]); ?>

        <?= $form_pass->field($model, 'old_password')->passwordInput(['maxlength' => true]); ?>
        
        <?= $form_pass->field($model, 'new_password')->passwordInput(['maxlength' => true]); ?>
        
        <?= $form_pass->field($model, 'repeat_password')->passwordInput(['maxlength' => true]); ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    
</div>

