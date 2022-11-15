<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inventoryitems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventoryitems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_item')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'last_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_date')->textInput() ?>

    <?= $form->field($model, 'fk_third')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
