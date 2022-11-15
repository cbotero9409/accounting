<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Chartaccounts */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/chartAccount.js');
?>

<div class="chartaccounts-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php
//    if (Yii::$app->session->hasFlash('errors')): 
    ?>
    <!--<div class="py-1 mb-3 text-danger">-->
    <?php
//            echo Yii::$app->session->getFlash('errors');
    ?>
    <!--</div>-->
    <?php
//    endif;
    ?>

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true, 'validationUrl' => ['ajax-validation'], 'options' => ['onsubmit' => 'inputConcepts()']]); ?>



    <?php if ($model->isNewRecord) { ?>
        <div class="row">
            <div class="col-11">
                <?= $form->field($model, 'fk_account')->dropDownList($option_accounts, ['prompt' => 'Seleccionar Cuenta Base', 'onchange' => 'selectAccount(this)']); ?>
            </div>
            <div class="col-1 btn_ch_acc">
                <?= Html::button('+', ['class' => 'btn-primary btn', 'onclick' => "addAccount('$account_id')"]) ?>
            </div>
        </div>                  
    <?php } ?>

    <?php
    if ($model->isNewRecord) {
        echo "<div id='main_div' class='d-none'>";
    } else {
        echo "<div id='main_div'>";
    }
    ?>
<?= $form->field($model, 'code')->textInput(['maxlength' => true, 'readonly' => true, 'placeholder' => 'Código']); ?>


    <?= $form->field($model, 'account')->textInput(['maxlength' => true, 'placeholder' => 'Nombre de la cuenta']) ?>

    <?=
    $form->field($model, 'fk_account_type')->widget(Select2::classname(), [
        'data' => $accounts_types,
        'options' => ['placeholder' => 'Seleccionar Tipo de Cuenta...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($model, 'class')->widget(Select2::classname(), [
        'data' => $accounts_classes,
        'options' => ['placeholder' => 'Seleccionar Clase...', 'onchange' => 'selectClass(this.value)'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>   

    <?php
    if ($model->class == 1) {
        echo "<div id='account_class_1' class='border rounded bg-light p-3'>";
    } else {
        echo "<div id='account_class_1' class='d-none border rounded bg-light p-3'>";
    }
    ?>

    <?=
    $form->field($taxes_conf_model, 'iva')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'retention')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'rete_ica')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'tax_cree')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'auto_retention')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'other')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=
    $form->field($taxes_conf_model, 'other_2')->widget(Select2::classname(), [
        'data' => $retentions,
        'options' => ['placeholder' => 'Seleccionar ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
</div>

<?php
if ($model->class == 3) {
    echo "<div id='account_class_3'>";
} else {
    echo "<div id='account_class_3' class='d-none'>";
}
?>

<?=
$form->field($model, 'fk_tax')->widget(Select2::classname(), [
    'data' => $taxes,
    'options' => ['placeholder' => 'Seleccionar Impuesto...', 'onchange' => 'selectTax(this)'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);
?>

<div id="taxfeed"></div>

</div>

<?php
if ($model->class == 5) {
    echo "<div id='account_class_5'>";
} else {
    echo "<div id='account_class_5' class='d-none'>";
}
?>        
<div class="form-group my-3" id="concepts">
    <select id="concepts_select" class="form-control" onchange="addConcept(this)">
        <option>Agregar Concepto</option>
<?= $option_retentions; ?>
    </select>
</div>
<div id="concepts_list" class="m-3">
    <?php
    if ($model->class == 5) {
        $concepts_input = '';
        foreach ($all_concepts as $concept) {
            $concepts_input .= $concept->concept . ',';
            $concept_code = $concept->concept0->code;
            $concept_retention = $concept->concept0->name;
            $concept_date = $concept->concept0->validity_start;
            $concept_text = "$concept_code - $concept_retention - $concept_date";
            print "<div class='row py-2 bg-light border rounded' id='concept$concept->concept'>
                <div class='col-12'>
                    $concept_text
                    <button class='btn btn-link float_right btn_concepts' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteConcept($concept->concept)'><i class='fas fa-trash-alt'></i></button>
                </div>
            </div>";
        }
        ?>
        <input type='hidden' name='update_concepts' id='update_concepts' value='<?= substr($concepts_input, 0, -1); ?>'/>
        <?php
    }
    ?>
</div>
<input type="hidden" name="concepts_input" id="concepts_input"/>
</div>

<div class="my-4">

    <?= $form->field($model, 'handle_third_parties')->checkBox() ?>

    <?= $form->field($model, 'controls_indebtedness')->checkBox() ?>

    <?= $form->field($model, 'handle_references')->checkBox() ?>

    <?= $form->field($model, 'discriminate_by_third_party')->checkBox() ?>

    <?= $form->field($model, 'demands_base_value')->checkBox() ?>

    <?= $form->field($model, 'visible_in_selection')->checkBox() ?>

    <?= $form->field($model, 'local_account')->checkBox() ?>

    <?= $form->field($model, 'niif_account')->checkBox() ?>    

<?= $form->field($model, 'use_niif_equivalent_account')->checkBox() ?> 

</div>
</div>

<div class="form-group">
    <?php if ($model->isNewRecord) { 
        echo Html::submitButton('Guardar', ['class' => 'btn btn-success', 'disabled' => true, 'id' => 'button_submit']);
    } else {
        echo Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'button_submit']);
    }
?>
</div>

<?php ActiveForm::end(); ?>

</div>

