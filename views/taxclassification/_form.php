<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Taxclassification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxclassification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_economic_activity')->textInput() ?>

    <?= $form->field($model, 'tax_profile')->textInput() ?>

    <?= $form->field($model, 'pn')->textInput() ?>

    <?= $form->field($model, 'pj')->textInput() ?>

    <?= $form->field($model, 'pe')->textInput() ?>

    <?= $form->field($model, 'to1')->textInput() ?>

    <?= $form->field($model, 'ts')->textInput() ?>

    <?= $form->field($model, 'rs')->textInput() ?>

    <?= $form->field($model, 'rc')->textInput() ?>

    <?= $form->field($model, 'gc')->textInput() ?>

    <?= $form->field($model, 'av')->textInput() ?>

    <?= $form->field($model, 'ar')->textInput() ?>

    <?= $form->field($model, 'ag')->textInput() ?>

    <?= $form->field($model, 'nc')->textInput() ?>

    <?= $form->field($model, 'c1')->textInput() ?>

    <?= $form->field($model, 'c2')->textInput() ?>

    <?= $form->field($model, 'c3')->textInput() ?>

    <?= $form->field($model, 'ri')->textInput() ?>

    <?= $form->field($model, 'ee')->textInput() ?>

    <?= $form->field($model, 'ie')->textInput() ?>

    <?= $form->field($model, 'ed')->textInput() ?>

    <?= $form->field($model, 'ni')->textInput() ?>

    <?= $form->field($model, 'tax_administration')->textInput() ?>

    <?= $form->field($model, 'economic_clasification')->textInput() ?>

    <?= $form->field($model, 'declarant_class')->textInput() ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'ic')->textInput() ?>

    <?= $form->field($model, 'iva_inc')->textInput() ?>

    <?= $form->field($model, 'does_not_apply')->textInput() ?>

    <?= $form->field($model, 'fk_company')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
