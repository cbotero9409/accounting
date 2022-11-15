<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesconfiguration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxesconfiguration-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'iva')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'retention')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'rete_ica')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'tax_cree')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'auto_retention')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'other')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'other_2')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
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
