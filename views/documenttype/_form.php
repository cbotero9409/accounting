<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Documenttype */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/docType.js');

?>

<div class="documenttype-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'code')->textInput(['maxlength' => true]);
    }
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'onchange' => 'mask(this)']) ?>

    <?= $form->field($model, 'mask')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'numbering_type')->widget(Select2::classname(), [
        'data' => $num_type,
        'options' => ['placeholder' => 'Seleccionar Tipo...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
