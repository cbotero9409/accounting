<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Taxes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxes-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => $type,
        'options' => ['placeholder' => 'Seleccionar cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value')->textInput(['type' => 'number'], ['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
