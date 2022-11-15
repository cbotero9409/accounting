<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Incomelist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incomelist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_chart_account')->textInput() ?>

    <?= $form->field($model, 'concept')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'fk_cost_center')->textInput() ?>

    <?= $form->field($model, 'fk_bill')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
