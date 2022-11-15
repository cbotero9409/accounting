<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Companylabel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companylabel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'main_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mt_size')->textInput() ?>

    <?= $form->field($model, 'mt_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subt_size')->textInput() ?>

    <?= $form->field($model, 'subt_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_size')->textInput() ?>

    <?= $form->field($model, 'detail_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'footer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'footer_size')->textInput() ?>

    <?= $form->field($model, 'footer_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header_type')->textInput() ?>

    <?= $form->field($model, 'fk_company')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
