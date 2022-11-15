<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Thirdparties */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/thirdparties.js');
?>

<div class="thirdparties-form mt-4">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'enableAjaxValidation' => true]); ?>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">Datos Generales</a>
            <a class="nav-item nav-link" id="nav-tax-tab" data-toggle="tab" href="#nav-tax" role="tab" aria-controls="nav-tax" aria-selected="false">Clasificación Tributaria</a>
            <a class="nav-item nav-link" id="nav-supplier-tab" data-toggle="tab" href="#nav-supplier" role="tab" aria-controls="nav-supplier" aria-selected="false">Datos Proveedor</a>
            <a class="nav-item nav-link" id="nav-additional-tab" data-toggle="tab" href="#nav-additional" role="tab" aria-controls="nav-additional" aria-selected="false">Datos Adicionales</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
            <div class ="p-3 border rounded bg-light">
                <div class="row border-bottom pb-2">
                    <div class="col-12">
                        <span class="h5">Información General</span>
                    </div>                
                </div>

                <?php if (isset($model->fk_third)) { ?>
                    <div class="row pt-2">
                        <div class="col-3">
                            <?php echo $form->field($model, 'fk_third')->textInput(['readonly' => true]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Código', 'readonly' => true]) ?>   
                    <?php } else { ?>
                        <div class="row pt-2">
                             <div class="col-3">
                            <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'placeholder' => 'Código']) ?>                        
                        <?php } ?>
                       </div>
                        <div class="col-3">
                            <?= $form->field($model, 'dv')->textInput(['maxlength' => true, 'placeholder' => 'D.V.']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'doc_type')->dropDownList($doc_type, ['prompt' => 'Seleccionar Tipo de Documento']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <?= $form->field($model, 'tradename')->textInput(['maxlength' => true, 'placeholder' => 'Nombre Comercial']) ?>
                        </div>
                        <div class="col-3 mt-4">
                            <?= $form->field($model, 'visible')->checkbox() ?>
                        </div>
                        <div class="col-3 mt-4">
                            <?= $form->field($model, 'juridical')->checkbox() ?>
                        </div>
                        <div class="col-3 mt-4">
                            <?= $form->field($model, 'branch_office')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row border-top pt-2">
                        <div class="col-3">
                            <?= $form->field($model, 'treatment')->textInput(['maxlength' => true, 'placeholder' => 'Señor(a)']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'profession')->textInput(['maxlength' => true, 'placeholder' => 'Profesión']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'company')->textInput(['maxlength' => true, 'placeholder' => 'Empresa']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'appointment')->textInput(['maxlength' => true, 'placeholder' => 'Cargo']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <?= $form->field($model, 'genre')->dropDownList([0 => 'Masculino', 1 => 'Femenino'], ['prompt' => 'Seleccionar Género']) ?>
                        </div>
                        <div class="col-3">
                            <?=
                            $form->field($model, 'birthday')->widget(DatePicker::classname(), [
                                'options' => ['placeholder' => 'Fecha de Nacimiento'],
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'quick_code')->textInput(['maxlength' => true, 'placeholder' => 'Código Rápido']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <?= $form->field($model, 'processing_personal_data')->checkbox() ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'transactional_info')->checkbox() ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'promotional_info')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row border-top border-bottom py-2">
                        <div class="col-12">
                            <span class='h5'>Contacto</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-3">
                            <?= $form->field($contact_model, 'cell_phone')->textInput(['maxlength' => true, 'placeholder' => 'Celular']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($contact_model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Teléfono']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($contact_model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Correo Electrónico']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($contact_model, 'web_page')->textInput(['maxlength' => true, 'placeholder' => 'Página Web']) ?>
                        </div>
                    </div>
                    <div class="row border-top pt-2">
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
                            <?= $form->field($model, 'address')->textInput(['placeholder' => 'Dirección']) ?>
                        </div>
                    </div>
                    <div class="row border-top border-bottom py-2">
                        <div class="col-12">
                            <span class='h5'>Tipo de Tercero</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-2">
                            <?= $form->field($model, 'supplier')->checkbox() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'client')->checkbox() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'employee')->checkbox() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'seller')->checkbox() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'interested')->checkbox() ?>
                        </div>
                        <div class="col-2">
                            <?= $form->field($model, 'associate')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row border-top border-bottom py-2">
                        <div class="col-12">
                            <span class='h5'>Cuenta Bancaria</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-3">
                            <?= $form->field($model, 'account_holder')->textInput(['maxlength' => true, 'placeholder' => 'Titular de la Cuenta']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder' => 'Número de la Cuenta']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'account_bank')->dropDownList($banks, ['prompt' => 'Seleccionar Banco']) ?>
                        </div>
                        <div class="col-3">
                            <?= $form->field($model, 'account_type')->dropDownList($account_type, ['prompt' => 'Seleccionar Tipo de Cuenta']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <?= $form->field($model, 'account_payment_method')->textInput(['maxlength' => true, 'placeholder' => 'Forma de Pago']) ?>
                        </div>
                    </div>
                    <div class="row border-top border-bottom py-2">
                        <div class="col-6">
                            <?php
                            if ($model->photo !== NULL) {
                                echo $form->field($model, 'uploaded_photo')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*'],
                                    'pluginOptions' => [
                                        'initialPreview' => [
                                            "../img/third_parties/$model->photo"
                                        ],
                                        'initialPreviewAsData' => true,
                                        'initialPreviewConfig' => [
                                            ['caption' => "$model->photo"],
                                        ],
                                        'showUpload' => false, 'showCancel' => false,
                                ]]);
                            } else {
                                echo $form->field($model, 'uploaded_photo')->widget(FileInput::classname(), ['options' => ['accept' => 'image/*']]);
                            }
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
                                'options' => ['placeholder' => 'Seleccionar Actividad Económica'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-6">
                            <?=
                            $form->field($tax_clasif_model, 'tax_profile')->widget(Select2::classname(), [
                                'data' => $tax_profiles,
                                'options' => ['placeholder' => 'Seleccionar Perfil Tributario'],
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
                </div>
            </div>
            <div class="tab-pane fade" id="nav-supplier" role="tabpanel" aria-labelledby="nav-supplier-tab">
                <div class ="p-3 border rounded bg-light">
                    <div class="row border-bottom pb-2">
                        <div class="col-12">
                            <span class="h5">Proveedor</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-1">
                            <label>Tipo:</label>
                        </div>
                        <div class="col-5">
                            <?= $form->field($model, 'standard_supplier')->checkbox() ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'payroll_entity_supplier')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row border-top pt-3">
                        <div class="col-6">
                            <?= $form->field($model, 'payment_deadline')->textInput(['placeholder' => 'Plazo de Pago', 'type' => 'number']) ?>
                        </div>
                        <div class="col-6 mt-4">
                            <?= $form->field($model, 'block_payments')->checkbox() ?>
                        </div>
                    </div>
                    <div class="row border-bottom border-top py-3">
                        <div class="col-12">
                            <span class="h5">Líneas de Productos</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-11">
                            <div class="form-group">
                                <input type="text" id="product_lines_main" class="form-control" name="product_lines_main" aria-invalid="false" placeholder='Línea'>
                            </div>
                        </div>
                        <div class="col-1">
                            <?= Html::button('+ Agregar', ['class' => 'btn btn-primary float_right', 'onclick' => 'addLine()']) ?>
                        </div>
                    </div>
                    <div id='lines_list'>
                        <?php
                        if (!$model->isNewRecord) {
                            $i = 0;
                            foreach ($all_lines as $line) {
                                ?>
                                <div class='row' id='line<?= $i ?>'>
                                    <div class='col-11'>
                                        <input type='text' class='form-control' name='product_lines[]' aria-invalid='false' value='<?= $line->line ?>'>
                                    </div>
                                    <div class='col-1'>
                                        <button type='button' class='btn btn-link' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('line<?= $i ?>')">
                                            <i class='fas fa-trash-alt'></i>
                                        </button>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                            ?> 
                            <input type="hidden" id="update_lines" name="update_lines" value='<?= $i ?>'>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row border-bottom border-top py-3">
                        <div class="col-12">
                            <span class="h5">Elementos de Inventario</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Elemento</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Código</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Precio Ultima Compra</th>
                                        <th scope="col">Fecha Ultima Compra</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_item_body">
                                    <tr>
                                        <td><select class="form-control" id="item_element_main"><option value=''>Seleccionar Elemento</option><?= $option_items; ?></select></td> 
                                        <td><input type="number" id="item_unit_main" class="form-control" name="item_unit_main" aria-invalid="false" placeholder='Unidad' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="text" id="item_code_main" class="form-control" name="item_code_main" aria-invalid="false" placeholder='Código'></td>
                                        <td><input type="text" id="item_price_main" class="form-control" name="item_price_main" aria-invalid="false" placeholder='Precio' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="date" id="item_date_main" class="form-control" name="item_date_main" aria-invalid="false" placeholder='Fecha'></td>
                                        <td><input type="text" id="item_lastprice_main" class="form-control" name="item_lastprice_main" aria-invalid="false" placeholder='Ultimo Precio' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="date" id="item_lastdate_main" class="form-control" name="item_lastdate_main" aria-invalid="false" placeholder='Ultima Fecha'></td>
                                        <td><?= Html::button('+', ['class' => 'btn btn-primary float_right', 'onclick' => 'addItem()']) ?></td>
                                    </tr>
                                    <?php
                                    if (!$model->isNewRecord) {
                                        $j = 0;
                                        foreach ($all_items as $item) {
                                            $item_name = $item->fkItem->item;
                                            ?>
                                            <tr id='item<?= $j ?>'>
                                                <td><input type="text" class="form-control" name="item_element_text" aria-invalid="false" value='<?= $item_name ?>' readonly></td>
                                        <input type="hidden" name="item_element[]" value='<?= $item->fk_item ?>'>
                                        <td><input type="number" class="form-control" name="item_unit[]" aria-invalid="false" value='<?= $item->unit ?>' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="text" class="form-control" name="item_code[]" aria-invalid="false" value='<?= $item->code ?>'></td>
                                        <td><input type="text" class="form-control" name="item_price[]" aria-invalid="false" value='<?= $item->price ?>' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="date" class="form-control" name="item_date[]" aria-invalid="false" value='<?= $item->date ?>'></td>
                                        <td><input type="text" class="form-control" name="item_price_last[]" aria-invalid="false" value='<?= $item->last_price ?>' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="date" class="form-control" name="item_date_last[]" aria-invalid="false" value='<?= $item->last_date ?>'></td>
                                        <td><button class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('item<?= $j ?>')"><i class='fas fa-trash-alt'></i></button></td>                                    
                                        </tr>
                                        <?php
                                        $j++;
                                    }
                                    ?> 
                                    <input type="hidden" id="update_items" name="update_items" value='<?= $j ?>'>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div class="row border-bottom border-top py-3">
                        <div class="col-12">
                            <span class="h5">Productos Comprados</span>
                        </div>                
                    </div>
                    <div class="row pt-3">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Número de Documento</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Tipo de Movimiento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_purch_body">
                                    <tr>
                                        <td><input type="text" id="purchased_code_main" class="form-control" name="purchased_code_main" aria-invalid="false" placeholder='Código'></td> 
                                        <td><input type="text" id="purchased_product_main" class="form-control" name="purchased_product_main" aria-invalid="false" placeholder='Producto'></td>
                                        <td><input type="number" id="purchased_unit_main" class="form-control" name="purchased_unit_main" aria-invalid="false" placeholder='Unidad' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="date" id="purchased_date_main" class="form-control" name="purchased_date_main" aria-invalid="false" placeholder='Fecha'></td>
                                        <td><input type="text" id="purchased_docnum_main" class="form-control" name="purchased_docnum_main" aria-invalid="false" placeholder='Número de Documento' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="text" id="purchased_price_main" class="form-control" name="purchased_price_main" aria-invalid="false" placeholder='Precio' onkeypress="return onlyNumbers(event)"></td>
                                        <td><input type="text" id="purchased_movetype_main" class="form-control" name="purchased_movetype_main" aria-invalid="false" placeholder='Tipo de Movimiento'></td>
                                        <td><?= Html::button('+', ['class' => 'btn btn-primary float_right', 'onclick' => 'addPurchasedItem()']) ?></td>
                                    </tr>
                                    <?php
                                    if (!$model->isNewRecord) {
                                        $k = 0;
                                        foreach ($all_purchased as $purch) {
                                            ?>
                                            <tr id='purch<?= $k ?>'>
                                                <td><input type="text" class="form-control" name="purch_code[]" aria-invalid="false" value='<?= $purch->code ?>'></td>
                                                <td><input type="text" class="form-control" name="purch_product[]" aria-invalid="false" value='<?= $purch->product ?>'></td>
                                                <td><input type="number" class="form-control" name="purch_unit[]" aria-invalid="false" value='<?= $purch->unit ?>' onkeypress="return onlyNumbers(event)"></td>
                                                <td><input type="date" class="form-control" name="purch_date[]" aria-invalid="false" value='<?= $purch->date ?>'></td>
                                                <td><input type="text" class="form-control" name="purch_docnumber[]" aria-invalid="false" value='<?= $purch->doc_number ?>' onkeypress="return onlyNumbers(event)"></td>
                                                <td><input type="text" class="form-control" name="purch_price[]" aria-invalid="false" value='<?= $purch->price ?>' onkeypress="return onlyNumbers(event)"></td>
                                                <td><input type="text" class="form-control" name="purch_movetype[]" aria-invalid="false" value='<?= $purch->movement_type ?>'></td>
                                                <td><button type="button" class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteLine('purch<?= $k ?>')"><i class='fas fa-trash-alt'></i></button></td>
                                            </tr>
                                            <?php
                                            $k++;
                                        }
                                        ?> 
                                    <input type="hidden" id="update_purchased" name="update_purchased" value='<?= $k ?>'>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-additional" role="tabpanel" aria-labelledby="nav-additional-tab">
                <div class ="p-3 border rounded bg-light">
                    <div class="row border-bottom pb-2">
                        <div class="col-6">
                            <?= $form->field($model, 'alternate_code')->textInput(['maxlength' => true, 'placeholder' => 'Código Alterno']) ?>
                        </div>      
                        <div class="col-6">
                            <?= $form->field($model, 'class')->textInput(['maxlength' => true, 'placeholder' => 'Clase']) ?>
                        </div> 
                    </div>
                    <div class="row pt-3">
                        <?= $form->field($model, 'additional_notes')->textarea(['rows' => 6]) ?>
                    </div>
                    <div class="row border-top border-bottom py-2">
                        <div class="col-6">
                            <?php
                            if (!empty($files_array)) {
                                echo $form->field($files_model, 'uploaded_files[]')->widget(FileInput::classname(),
                                        [
                                            'options' => ['multiple' => true],
                                            'pluginOptions' => [
                                                'initialPreview' => $files_array,
                                                'initialPreviewAsData' => true,
                                                'initialPreviewConfig' => $files_name,
                                                'showUpload' => false,
                                                'showCancel' => false,
                                ]]);
                            } else {
                                echo $form->field($files_model, 'uploaded_files[]')->widget(FileInput::classname(), ['options' => ['multiple' => true],
                                    'pluginOptions' => ['showUpload' => false, 'showCancel' => false]]);
                            }
                            ?>
                        </div>
                    </div>
                </div>        
            </div>        
        </div>

        <div class="form-group mt-3">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
