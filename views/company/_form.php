<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/company.js');
?>

<div class="company-form mt-4">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">Datos Generales</a>
            <a class="nav-item nav-link" id="nav-tax-tab" data-toggle="tab" href="#nav-tax" role="tab" aria-controls="nav-tax" aria-selected="false">Clasificación Tributaria / Cartera y Proveedores</a>
            <a class="nav-item nav-link" id="nav-billing-tab" data-toggle="tab" href="#nav-billing" role="tab" aria-controls="nav-billing" aria-selected="false">Rótulo / Facturación Electrónica</a>
        </div>
    </nav>
    <?php
        if (isset($view)) {
            $disabled = true;
    echo "<fieldset disabled='disabled'>";
        } else {
            $disabled = false;
        }
        ?>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Información General</span>
                    </div>                
                </div>
                <div class="row pt-2">
                    <div class="col-3">
                        
                        <?= $form->field($model, 'business_name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre']) ?>
                    </div>
                    <div class="col-3">
                        <?=
                        $form->field($model, 'doc_type')->widget(Select2::classname(), [
                            'data' => $doc_type,
                            'options' => ['placeholder' => 'Seleccionar Tipo de Documento...', 'disabled' => $disabled],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'doc_number')->textInput(['maxlength' => true, 'placeholder' => 'Número de Documento']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'manager')->textInput(['maxlength' => true, 'placeholder' => 'Gerente']) ?>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-3">
                        <?= $form->field($model, 'dv')->textInput(['placeholder' => 'D.V.']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre Corto']) ?>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="model_color">Color</label>
                            <input class="form-control" type="color" id="model_color" name="model_color" value="<?= $colors[0] ?>">
                        </div>
                    </div>  
                </div>        
                <div class="row border-top pt-3">          
                    <div class="col-3">
                        <?= $form->field($model, 'legal_representative')->textInput(['maxlength' => true, 'placeholder' => 'Representante Legal']) ?>
                    </div>
                    <div class="col-3 border-right">
                        <?= $form->field($model, 'representative_doc')->textInput(['maxlength' => true, 'placeholder' => 'Número de Documento']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'accountant')->textInput(['maxlength' => true, 'placeholder' => 'Contador']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'accountant_doc')->textInput(['maxlength' => true, 'placeholder' => 'Número de Documento']) ?>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-3">
                        <?= $form->field($model, 'tax_auditor')->textInput(['maxlength' => true, 'placeholder' => 'Revisor Fiscal']) ?>
                    </div>
                    <div class="col-3 border-right">
                        <?= $form->field($model, 'auditor_doc')->textInput(['maxlength' => true, 'placeholder' => 'Número de Documento']) ?>
                    </div>
                </div>
                <div class="row border-top pt-3">
                    <div class="col-3">
                        <?= $form->field($model, 'e_billing_management')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'doc_platform')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'own_email_sender')->checkbox() ?>
                    </div>
                </div>
            </div>

            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Datos de Contacto</span>
                    </div>                
                </div>
                <div class="row pt-2">
                    <div class="col-3">            
                        <?= $form->field($contacts_model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre de Contacto']) ?>
                    </div>
                    <div class="col-3"> 
                        <?= $form->field($contacts_model, 'person_type')->dropDownList(["Natural" => "Natural", "Jurídica" => "Jurídica"], ['prompt' => 'Seleccionar Tipo de Persona']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($contacts_model, 'cell_phone')->textInput(['maxlength' => true, 'placeholder' => 'Celular de Contacto']) ?>
                    </div>
                    <div class="col-3"> 
                        <?= $form->field($contacts_model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Teléfono de Contacto']) ?>
                    </div>
                </div>
                <div class="row">            
                    <div class="col-3"> 
                        <?= $form->field($contacts_model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Correo Electrónico']) ?>
                    </div>
                </div>
            </div>

            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Dirección</span>
                    </div>                
                </div>
                <div class="row pt-2">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="dept_form">Departamento</label>
                            <select class="form-control" id="dept_form" onchange="deptsFunction(this.value)">
                                <option>Seleccionar Departamento</option>
                                <?= $depts; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <?= $form->field($model, 'fk_municipality')->dropDownList($munic, ['prompt' => 'Seleccionar Municipio']) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Dirección']) ?>
                    </div>
                </div>
            </div>
            <div class ="p-3 mb-5 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Vigencia</span>
                    </div>                
                </div>
                <div class="row pt-2">
                    <div class="col-3">
                        <?=
                        $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Inicio de Vigencia ...'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="col-3">
                        <?=
                        $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Fin de Vigencia ...'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]);
                        ?>
                    </div>            
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-tax" role="tabpanel" aria-labelledby="nav-tax-tab">
            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Clasificación Tributaria</span>
                    </div>                
                </div>
                <div class="row pt-2">
                    <div class="col-6">
                        <?=
                        $form->field($tax_clasif_model, 'fk_economic_activity')->widget(Select2::classname(), [
                            'data' => $economic_activity,
                            'options' => ['placeholder' => 'Seleccionar Actividad Económica...', 'disabled' => $disabled],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-6">
                        <?=
                        $form->field($tax_clasif_model, 'tax_profile')->widget(Select2::classname(), [
                            'data' => $tax_profile,
                            'options' => ['placeholder' => 'Seleccionar Perfil Tributario...', 'disabled' => $disabled],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'pn')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'pj')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'pe')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'to1')->checkbox() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ts')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'rs')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'rc')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'gc')->checkbox() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'av')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ar')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ag')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'nc')->checkbox() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'c1')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'c2')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'c3')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ri')->checkbox() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ee')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ie')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ed')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ni')->checkbox() ?>
                    </div>
                </div>
                <div class="row border-top pt-3">         
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'tax_administration')->textInput(['placeholder' => 'Administración de Impuestos']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'economic_clasification')->textInput(['placeholder' => 'Clasificación Económica']) ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'declarant_class')->textInput(['placeholder' => 'Clase de Declarante']) ?>
                    </div>
                </div>
            </div>
            <div class ="px-3 pt-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Responsabilidades Tributarias</span>
                    </div>                
                </div>
                <div class="row pt-3">
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'iva')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'ic')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'iva_inc')->checkbox() ?>
                    </div>
                    <div class="col-3">
                        <?= $form->field($tax_clasif_model, 'does_not_apply')->checkbox() ?>
                    </div>
                </div>
            </div>
            <div class ="p-3 mb-5 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Cartera y proveedores</span>
                    </div>                
                </div>
                <div class="row pt-3">
                    <div class="col-2">
                        <?= $form->field($model, 'cxc_term')->textInput(['type' => 'number', 'value' => 30]) ?>
                    </div>
                    <div class="col-2">
                        <?= $form->field($model, 'cxp_term')->textInput(['type' => 'number', 'value' => 30]) ?>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-6 mt-4">
                        <?= $form->field($model, 'interest_management')->checkbox() ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-billing" role="tabpanel" aria-labelledby="nav-billing-tab">
            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Facturación Electrónica</span>
                    </div>                
                </div>
                <div class="row pt-3">
                    <div class="col-12">
                        <?= $form->field($model, 'electronic_billing')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
            <div class ="p-3 mb-5 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Rótulo</span>
                    </div>                
                </div>
                <div class="row pt-3">
                    <div class="col-10">
                        <?= $form->field($label_model, 'main_title')->textInput(['maxlength' => true, 'placeholder' => 'Título Principal']) ?>
                    </div>
                    <div class="col-1">
                        <?= $form->field($label_model, 'mt_size')->textInput(['type' => 'number', 'value' => 14])->label('Tamaño') ?>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="mt_color">Color</label>
                            <input class="form-control" type="color" id="mt_color" name="mt_color" value="<?= $colors[1] ?>">
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-10">
                        <?= $form->field($label_model, 'subtitle')->textInput(['maxlength' => true, 'placeholder' => 'Subtítulo']) ?>
                    </div>
                    <div class="col-1">
                        <?= $form->field($label_model, 'subt_size')->textInput(['type' => 'number', 'value' => 14])->label('Tamaño') ?>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="subt_color">Color</label>
                            <input class="form-control" type="color" id="subt_color" name="subt_color" value="<?= $colors[2] ?>">
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-10">
                        <?= $form->field($label_model, 'detail')->textInput(['maxlength' => true, 'placeholder' => 'Detalle']) ?>
                    </div>
                    <div class="col-1">
                        <?= $form->field($label_model, 'detail_size')->textInput(['type' => 'number', 'value' => 14])->label('Tamaño') ?>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="detail_color">Color</label>
                            <input class="form-control" type="color" id="detail_color" name="detail_color" value="<?= $colors[3] ?>">
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-10">
                        <?= $form->field($label_model, 'footer')->textInput(['maxlength' => true, 'placeholder' => 'Pie de Página']) ?>
                    </div>
                    <div class="col-1">
                        <?= $form->field($label_model, 'footer_size')->textInput(['type' => 'number', 'value' => 14])->label('Tamaño') ?>
                    </div>
                    <div class="col-1">
                        <div class="form-group">
                            <label for="footer_color">Color</label>
                            <input class="form-control" type="color" id="footer_color" name="footer_color" value="<?= $colors[4] ?>">
                        </div>
                    </div>  
                </div>
                <div class="row border-top pt-3">          
                    <div class="col-12">
                        <?= $form->field($label_model, 'header_type', ['wrapperOptions' => ['style' => 'display:inline-block']])->inline(true)->radioList($header_type) ?>
                    </div>
                </div>
                <div class="row border-top pt-3">          
                    <div class="col-6">
                        <?php
                        if ($label_model->logo !== NULL) {
                            echo $form->field($label_model, 'logo_file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'initialPreview' => [
                                        "../img/company/$label_model->logo"
                                    ],
                                    'initialPreviewAsData' => true,
                                    'initialPreviewConfig' => [
                                        ['caption' => "$label_model->logo"]
                            ]]]);
                        } else {
                            echo $form->field($label_model, 'logo_file')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*']]);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php
        if (isset($view)) {
    echo "</fieldset>";
        }
        ?>

    <div class="form-group">
        <?php
        if (!isset($view)) {
            echo Html::submitButton('Guardar', ['class' => 'btn btn-success']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
