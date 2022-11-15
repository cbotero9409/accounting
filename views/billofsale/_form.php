<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Billofsale */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/billofsale.js');
?>

<div class="billofsale-form mt-4">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class ="p-3 mb-5 border rounded bg-light">
        <div class="row border-bottom pb-2">
            <div class="col-12">
                <span class="h5">Información General</span>
            </div>                
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <?=
                $form->field($model, 'fk_doc_type')->widget(Select2::classname(), [
                    'data' => $doc_type,
                    'options' => ['placeholder' => 'Seleccionar Tipo de Documento...', 'onchange' => 'billsDoc(this.value)'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'doc_number')->textInput(['maxlength' => true, 'placeholder' => 'Número de Documento..', 'readonly' => TRUE]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <?=
                $form->field($model, 'date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Fecha ...'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>
            <div class="col-6">
                <?=
                $form->field($model, 'class')->widget(Select2::classname(), [
                    'data' => $classes,
                    'options' => ['placeholder' => 'Seleccionar Tipo de Documento...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="dept_form">Departamento</label>
                    <select class="form-control" id="dept_form" onchange="deptsFunction(this.value)">
                        <option>Seleccionar Departamento</option>
                        <?= $depts; ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'fk_municipality')->dropDownList($munic, ['prompt' => 'Seleccionar Municipio']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'detail')->textInput(['maxlength' => true, 'placeholder' => 'Detalle..']) ?>
            </div>
            <div class="col-6">
                <?=
                $form->field($model, 'cost_center')->widget(Select2::classname(), [
                    'data' => $cost_center,
                    'options' => ['placeholder' => 'Seleccionar Centro de Costos...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?=
                $form->field($model, 'client')->widget(Select2::classname(), [
                    'data' => $accounts,
                    'options' => ['placeholder' => 'Seleccionar Cliente...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
            <div class="col-6">
                <?=
                $form->field($model, 'seller')->widget(Select2::classname(), [
                    'data' => $accounts,
                    'options' => ['placeholder' => 'Seleccionar Vendedor...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div> 
    </div>

    <div class ="p-2 mb-5 border rounded bg-light">    
        <span class="h5">Lista de Ingresos</span>
        <table class="table mt-2">
            <thead class="thead-light"></thead>
            <tbody>
                <tr>                    
                    <td><?php
                        echo Select2::widget([
                            'name' => 'fk_chart_account',
                            'data' => $accounts,
                            'options' => [
                                'placeholder' => 'Seleccionar Cuenta de Ingresos..',
                            ],
                        ]);
                        ?>
                    </td>                    
                    <td><input type="text" class="form-control" name="inc_concept" id="income_concept" placeholder="Concepto de Ingresos.."></td>
                    <td><input type="number" class="form-control" name="inc_price" id="income_price" placeholder="Valor.." onkeypress="return isNumberKey(event)"></td>
                    <td>
                        <?php
                        echo Select2::widget([
                            'name' => 'fk_cost_center',
                            'data' => $cost_center,
                            'options' => [
                                'placeholder' => 'Seleccionar Centro de Costos a Cargar..',
                            ],
                        ]);
                        ?>
                    </td>
                    <td><?= Html::button('+', ['value' => /* Url::to("createcontact") */'', 'class' => 'btn btn-primary', 'onclick' => "addIncome()"]); ?></td>
                </tr>                
            </tbody>
        </table>
        <?php if ($model->isNewRecord) { ?>
            <div id="div_table_inc" class="d-none ">
            <?php } else { ?>
                <div id="div_table_inc" class="">
                <?php } ?>        
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cuenta de Ingresos</th>
                            <th scope="col">Concepto de Ingresos</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Centro de Costos a Cargar</th>
                        </tr>
                    </thead>
                    <tbody id="table_inc_body">
                        <?php
                        if (!$model->isNewRecord) {
                            $j = 0;
                            $i = 1;
                            $incomes_input_account = '';
                            $incomes_input_concept = '';
                            $incomes_input_price = '';
                            $incomes_input_cc = '';
                            foreach ($all_income_list as $incomes) {
                                $incomes_input_account .= $incomes->fk_chart_account . ',';
                                $incomes_input_concept .= $incomes->concept . ',';
                                $incomes_input_price .= $incomes->price . ',';
                                $incomes_input_cc .= $incomes->fk_cost_center . ',';
                                $account = $incomes->fkChartAccount->code . ' - ' . $incomes->fkChartAccount->account;
                                $concept = $incomes->concept;
                                $price = number_format($incomes->price, 2, '.', ',');
                                $income_cc = $incomes->fkCostCenter->code . ' - ' . $incomes->fkCostCenter->name;
                                echo "<div id='update_inc' class='d-none'><tr id='income$j'>
                                        <th scope='row' class='row_num'>$i</th>
                                        <td>$account</td>
                                        <td>$concept</td>
                                        <td>$price</td>
                                        <td>$income_cc<button class='btn btn-link float_right btn_concepts' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteIncome($j)'><i class='fas fa-trash-alt'></i></button></td>
                                      </tr></div>";
                                $i++;
                                $j++;
                            }
                            ?>
                        <input type='hidden' name='update_inc_account' id='update_inc_account' value='<?= substr($incomes_input_account, 0, -1); ?>'/>
                        <input type='hidden' name='update_inc_concept' id='update_inc_concept' value='<?= substr($incomes_input_concept, 0, -1); ?>'/>
                        <input type='hidden' name='update_inc_price' id='update_inc_price' value='<?= substr($incomes_input_price, 0, -1); ?>'/>
                        <input type='hidden' name='update_inc_cc' id='update_inc_cc' value='<?= substr($incomes_input_cc, 0, -1); ?>'/>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php if ($model->isNewRecord) { ?>
                <div id="partial_div" class="form-inline ">
                <?php } else { ?>
                    <div id="partial_div" class="form-inline">
                    <?php } ?>
                    <div class="form-group">                
                        <label for="partial">Valor Parcial: </label>            
                        <input class="form-control ml-5" type="text" placeholder="Valor Parcial…" readonly name="partial" id="partial_input">
                    </div>
                </div> 

                <input type="hidden" name="accounts_hidden" id="accounts_hidden"/>
                <input type="hidden" name="concepts_hidden" id="concepts_hidden"/>
                <input type="hidden" name="prices_hidden" id="prices_hidden"/>
                <input type="hidden" name="centers_hidden" id="centers_hidden"/>
            </div>

            <?php if ($model->isNewRecord) { ?>
                <div class ="p-2 mb-5 border rounded bg-light d-none" id="liquidation_concepts">
                <?php } else { ?>
                    <div class ="p-2 mb-5 border rounded bg-light" id="liquidation_concepts">
                    <?php } ?> 
                    <span class="h5">Liquidación de impuestos, descuentos y otros cargos</span>
                    <table class="table table-borderless border-top mt-2">
                        <thead class="thead-light"></thead>
                        <tbody>
                            <tr>                    
                                <td>
                                    <div class="form-group">
                                        <label for="concept_taxes">Concepto de Liquidación</label>
                                        <?php
                                        echo Select2::widget([
                                            'name' => 'concept_taxes',
                                            'data' => $retentions,
                                            'options' => [
                                                'placeholder' => 'Seleccionar Concepto de Liquidación..',
                                                'onchange' => 'conceptTaxes(this)'
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </td>
                                <td><div class="form-group"><label for="partial">Valor Base</label><input type="number" onchange="autoCalc()" class="form-control" name="base_value" id="base_value" placeholder="Valor Base.." onkeypress="return isNumberKey(event)"></div></td>
                                <td><div class="form-group"><label for="sign">Signo</label><input class="form-control" type="text" readonly name="sign" id="sign" style="width: 40px;"></div></td>
                                <td><div class="form-group"><label for="partial">Porcentaje (%)</label><input type="text" readonly onchange="autoCalc()" class="form-control" name="percentage" id="percentage" placeholder="Porcentaje.."></div></td>                    
                                <td>
                                    <div class="form-group">
                                        <label for="auto_calc">Auto-Calc.</label>
                                        <select class="form-control" id="auto_calc" onchange="autoCalc()" style="width: 70px;">
                                            <option value="1">Sí</option>
                                            <option value="0">No</option>                                
                                        </select>
                                    </div>
                                </td>
                                <td><div class="form-group"><label for="tax_value">Valor</label><input type="text" class="form-control" readonly name="tax_value" id="tax_value" placeholder="Valor.."></div></td>                    
                            </tr>
                        </tbody>            
                    </table>
                    <table class="table table_liquidation table-borderless">
                        <thead class="thead-light"></thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="affects_account">Afectará Cuenta</label>
                                        <?php
                                        echo Select2::widget([
                                            'name' => 'affects_account',
                                            'data' => $accounts,
                                            'options' => [
                                                'placeholder' => 'Seleccionar Cuenta..',
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="third_taxes">Tercero CXC</label>
                                        <?php
                                        echo Select2::widget([
                                            'name' => 'third_taxes',
                                            'data' => $accounts,
                                            'options' => [
                                                'placeholder' => 'Seleccionar Cuenta..',
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </td>
                                <td><div class="form-group"><label for="cc_active">CC Activo</label><input class="form-control" placeholder="CC Activo.." type="text" name="cc_active" id="cc_active""></div></td>
                                <td>
                                    <?php
                                    echo '<label class="control-label">Fecha de Pago</label>';
                                    echo DatePicker::widget([
                                        'options' => ['placeholder' => 'Seleccionar Fecha de Pago...'],
                                        'name' => 'payment_date',
                                        'pluginOptions' => [
                                            'startDate' => date('Y-m-d'),
                                            'autoclose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                    ?>
                                </td>
                                <td><div class="form-group"><label for="movement_type">Asiento</label><input type="text" class="form-control" readonly name="movement_type" id="movement_type" placeholder="Asiento.."></div></td>
                                <td><div class="form-group"><label for="min_base_value">Valor Base Mínimo</label><input type="text" class="form-control" readonly name="min_base_value" id="min_base_value" placeholder="Valor Base Mínimo.."></div></td>                    
                            </tr>            
                        </tbody>            
                    </table>  
                    <table class="table table_liquidation table-borderless border-bottom">
                        <tbody>
                            <tr>  
                                <td><div class="form-group"><label for="observation">Observación</label><input class="form-control" type="text" name="observation" id="observation" placeholder="Observación.."></div></td>
                                <td style="width: 40px;"><?= Html::button('+', ['value' => /* Url::to("createcontact") */'', 'class' => 'btn btn-primary button_liquidation', 'onclick' => "addConcept()"]); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if ($model->isNewRecord) { ?>
                        <div id="div_table_concepts" class="d-none ">
                        <?php } else { ?>
                            <div id="div_table_concepts" class="">
                            <?php } ?>             
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Concepto de Liquidación</th>
                                        <th scope="col">Valor Base</th>
                                        <th scope="col">Porcentaje</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Afectará Cuenta</th>
                                        <th scope="col">Tercero CXC</th>
                                        <th scope="col">CC Activo</th>
                                        <th scope="col">Fecha de Pago</th>
                                        <th scope="col">Asiento</th>
                                        <th scope="col">Valor Base Mínimo</th>
                                        <th scope="col">Observación</th>
                                    </tr>
                                </thead>
                                <tbody id="table_concepts_body">
                                    <?php
                                    if (!$model->isNewRecord) {
                                        $k = 0;
                                        $l = 1;
                                        $taxes_input_concept = '';
                                        $taxes_input_base = '';
                                        $taxes_input_value = '';
                                        $taxes_input_account = '';
                                        $taxes_input_third = '';
                                        $taxes_input_center = '';
                                        $taxes_input_date = '';
                                        $taxes_input_observation = '';
                                        $taxes_input_sign = '';
                                        foreach ($all_taxes_list as $taxeslist) {
                                            $taxes_input_concept .= $taxeslist->concept . ',';
                                            $taxes_input_base .= $taxeslist->base_value . ',';
                                            $taxes_input_value .= $taxeslist->price . ',';
                                            $taxes_input_account .= $taxeslist->account_to_affect . ',';
                                            $taxes_input_third .= $taxeslist->third_party . ',';
                                            $taxes_input_center .= $taxeslist->cc_active . ',';
                                            $taxes_input_date .= $taxeslist->payment_date . ',';
                                            $taxes_input_observation .= $taxeslist->observation . ',';
                                            $concept = $taxeslist->concept0->code . ' - ' . $taxeslist->concept0->name;
                                            $percentage = $taxeslist->concept0->value;
                                            $tax_account = $taxeslist->accountToAffect->code . ' - ' . $taxeslist->accountToAffect->account;
                                            $tax_third = $taxeslist->thirdParty->code . ' - ' . $taxeslist->thirdParty->account;
                                            if ($taxeslist->concept0->movement_type == '1') {
                                                $move_type = 'Débito';
                                            } elseif ($taxeslist->concept0->movement_type == '2') {
                                                $move_type = 'Crédito';
                                            }
                                            $min_base = number_format($taxeslist->concept0->min_base_value, 2, '.', ',');
                                            if ($taxeslist->concept0->how_affects == 1) {
                                                $sign = '-';
                                                $taxes_input_sign .= $sign . ',';
                                            } elseif ($taxeslist->concept0->how_affects == 2) {
                                                $sign = '';
                                                $taxes_input_sign .= $sign . ',';
                                            } elseif ($taxeslist->concept0->how_affects == 3) {
                                                $sign = '+';
                                                $taxes_input_sign .= $sign . ',';
                                            }
                                            $base_value = number_format($taxeslist->base_value, 2, '.', '');
                                            $price = number_format($taxeslist->price, 2, '.', ',');
                                            ?>
                                            <tr id='concept<?= $k ?>'>
                                                <th scope='row' class='row_concepts'><?= $l ?></th>
                                                <td><?= $concept ?></td>
                                                <td><input type='text' value='<?= $base_value ?>' class='form-control' style='width: 130px; height: 25px;' onchange="calculateTaxValue(this.value, '<?= $k ?>', '<?= $percentage ?>', '<?= $sign ?>')"></td>
                                                <td><?= $percentage ?>%</td>
                                                <td id='tax_value<?= $k ?>'><?= $sign . $price ?></td>
                                                <td><?= $tax_account ?></td>
                                                <td><?= $tax_third ?></td>
                                                <td><?= $taxeslist->cc_active ?></td>
                                                <td><?= $taxeslist->payment_date ?></td>
                                                <td><?= $move_type ?></td>
                                                <td><?= $min_base ?></td>
                                                <td class='table_invoices_description'><?= $taxeslist->observation ?><button class='btn btn-link float_right btn_concepts' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteConcept(<?= $k ?>)'><i class='fas fa-trash-alt'></i></button></td>      
                                            </tr>
                                            <?php
                                            $k++;
                                            $l++;
                                        }
                                        ?>
                                    <input type='hidden' name='update_tax_concept' id='update_tax_concept' value='<?= substr($taxes_input_concept, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_base' id='update_tax_base' value='<?= substr($taxes_input_base, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_value' id='update_tax_value' value='<?= substr($taxes_input_value, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_account' id='update_tax_account' value='<?= substr($taxes_input_account, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_third' id='update_tax_third' value='<?= substr($taxes_input_third, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_center' id='update_tax_center' value='<?= substr($taxes_input_center, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_date' id='update_tax_date' value='<?= substr($taxes_input_date, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_observation' id='update_tax_observation' value='<?= substr($taxes_input_observation, 0, -1); ?>'/>
                                    <input type='hidden' name='update_tax_sign' id='update_tax_sign' value='<?= substr($taxes_input_sign, 0, -1); ?>'/>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row col-12">
                            <div class="col-6">
                                <div class="form-group"><label for="total_aux">Valor Total</label><input type="text" class="form-control" readonly name="total_aux" id="total_aux" placeholder="Valor Total.."></div>
                                <?= $form->field($model, 'total_price')->hiddenInput()->label(false) ?>                
                            </div>
                            <div class="col-6">
                                <?= $form->field($model, 'reference')->textInput(['maxlength' => true, 'placeholder' => 'Referencia..']) ?>
                            </div>
                        </div>

                        <input type="hidden" name="tax_concept_hidden" id="tax_concept_hidden"/>
                        <input type="hidden" name="base_value_hidden" id="base_value_hidden"/>
                        <input type="hidden" name="tax_price_hidden" id="tax_price_hidden"/>
                        <input type="hidden" name="account_affects_hidden" id="account_affects_hidden"/>
                        <input type="hidden" name="thirds_hidden" id="thirds_hidden"/>
                        <input type="hidden" name="cc_hidden" id="cc_hidden"/>
                        <input type="hidden" name="date_hidden" id="date_hidden"/>
                        <input type="hidden" name="observation_hidden" id="observation_hidden"/>
                    </div>

                    <?php if ($model->isNewRecord) { ?>
                        <div class ="p-3 mb-5 border rounded bg-light d-none" id="payment_main_div">
                        <?php } else { ?>
                            <div class ="p-3 mb-5 border rounded bg-light" id="payment_main_div">
                            <?php } ?>
                            <span class="h5">Forma de Pago</span>        
                            <div class="form-group row border-top pt-3 mt-2">
                                <label for="subtraction" class="col-2 col-form-label">Valor Restante:</label>
                                <div class="col-10">
                                    <input type="text" class="form-control width_auto" id="subtraction" name="subtraction" placeholder="Valor Restante.." readonly>
                                </div>
                            </div>
                            <div class="row border-top pt-2">
                                <div class="col-4 border-right">
                                    <?= $form->field($model, 'cash')->textInput(['onkeypress' => "return isNumberKey(event)", 'onchange' => 'cashPayment()', 'placeholder' => '0.00']) ?>

                                    <?php if ($model->isNewRecord) { ?>
                                        <div id="cashpay" class="d-none ">
                                        <?php } else { ?>
                                            <div id="cashpay" class="">
                                            <?php } ?>
                                            <?=
                                            $form->field($model, 'account_cash')->widget(Select2::classname(), [
                                                'data' => $accounts,
                                                'options' => ['placeholder' => 'Seleccionar Cuenta...'],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]);
                                            ?>  
                                        </div>                              
                                    </div>
                                    <div class="col-4 border-right">
                                        <?= $form->field($model, 'cash_payment_bank')->textInput(['onchange' => 'bankPayment()', 'onkeypress' => "return isNumberKey(event)", 'placeholder' => '0.00']) ?>

                                        <?php if ($model->isNewRecord) { ?>
                                            <div id="cashbank" class="d-none ">
                                            <?php } else { ?>
                                                <div id="cashbank" class="">
                                                <?php } ?>                    
                                                <?=
                                                $form->field($bank_model, 'bank_account')->widget(Select2::classname(), [
                                                    'data' => $accounts,
                                                    'options' => ['placeholder' => 'Seleccionar Cuenta...'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]);
                                                ?>

                                                <?=
                                                $form->field($bank_model, 'movement_type')->widget(Select2::classname(), [
                                                    'data' => $mov_type,
                                                    'options' => ['placeholder' => 'Seleccionar Tipo...'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]);
                                                ?>

                                                <?= $form->field($bank_model, 'number')->textInput(['maxlength' => true, 'placeholder' => 'Número..']) ?>

                                                <?=
                                                $form->field($bank_model, 'date')->widget(DatePicker::classname(), [
                                                    'options' => ['placeholder' => 'Fecha de transacción ...'],
                                                    'pluginOptions' => [
                                                        'startDate' => date('Y-m-d'),
                                                        'autoclose' => true,
                                                        'format' => 'yyyy-mm-dd'
                                                    ]
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <?= $form->field($model, 'bill_to_pay')->textInput(['onchange' => 'billPayment()', 'onkeypress' => "return isNumberKey(event)", 'placeholder' => '0.00']) ?>

                                            <?php if ($model->isNewRecord) { ?>
                                                <div id="cashbill" class="d-none ">
                                                <?php } else { ?>
                                                    <div id="cashbill" class="">
                                                    <?php } ?>                    
                                                    <?=
                                                    $form->field($bills_model, 'third_party')->widget(Select2::classname(), [
                                                        'data' => $accounts,
                                                        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]);
                                                    ?>

                                                    <?=
                                                    $form->field($bills_model, 'account')->widget(Select2::classname(), [
                                                        'data' => $accounts,
                                                        'options' => ['placeholder' => 'Seleccionar Cuenta...'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true
                                                        ],
                                                    ]);
                                                    ?>

                                                    <?=
                                                    $form->field($bills_model, 'date_to_pay')->widget(DatePicker::classname(), [
                                                        'options' => ['placeholder' => 'Fecha de Pago ...'],
                                                        'pluginOptions' => [
                                                            'startDate' => date('Y-m-d'),
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ]
                                                    ]);
                                                    ?>

                                                    <?= $form->field($bills_model, 'number_of_fees')->textInput(['maxlength' => true, 'placeholder' => 'Cantidad de Cuotas..', 'type' => 'number', 'onkeypress' => "return isNumberKey(event)"]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class ="p-3 mb-5 border rounded bg-light">
                                        <div class="row border-bottom pb-2">
                                            <div class="col-12">
                                                <span class="h5">Datos Adicionales</span>
                                            </div>                
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col-6">
                                                <?=
                                                $form->field($model, 'type_of_operation')->widget(Select2::classname(), [
                                                    'data' => $type_operation,
                                                    'options' => ['placeholder' => 'Seleccionar Tipo de Operación...'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true
                                                    ],
                                                ]);
                                                ?>

                                                <?= $form->field($model, 'purchase_order_number')->textInput(['maxlength' => true, 'placeholder' => 'Número Orden de Compra..']) ?>

                                                <?= $form->field($model, 'observations')->textarea(['rows' => 6, 'placeholder' => 'Observaciones..']) ?>
                                            </div>
                                            <div class="col-6">                                              
                                                <?php
                                                if (!empty($files_array)) {
                                                    echo $form->field($uploads_model, 'uploaded_files[]')->widget(FileInput::classname(),
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
                                                    echo $form->field($uploads_model, 'uploaded_files[]')->widget(FileInput::classname(), ['options' => ['multiple' => true],
                                                                'pluginOptions' => ['showUpload' => false, 'showCancel' => false]]);
                                                }
                                                ?>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="form-group" id="submit_div">        
                                        <?= Html::button('Guardar', ['class' => 'btn btn-primary', 'onclick' => "submitForm()", 'disabled' => false, 'id' => 'button_submit']); ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>
