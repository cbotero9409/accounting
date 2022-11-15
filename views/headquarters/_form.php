<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Headquarters */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/headquarters.js');
?>

<div class="headquarters-form mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <div class ="p-3 border rounded bg-light">
        <div class="row border-bottom pb-2">
            <div class="col-12">
                <span class="h5">Información General</span>
            </div>                
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <?= $form->field($model, 'fk_company')->textInput(['disabled' => true]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre..']) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'short_name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre Corto..']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'manager')->textInput(['maxlength' => true, 'placeholder' => 'Responsable..']) ?>
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
            <div class="col-6">            
                <?= $form->field($contacts_model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nombre de Contacto..']) ?>
            </div>
            <div class="col-6"> 
                <?= $form->field($contacts_model, 'person_type')->dropDownList(["Natural" => "Natural", "Jurídica" => "Jurídica"], ['prompt' => 'Seleccionar Tipo de Persona..']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($contacts_model, 'cell_phone')->textInput(['maxlength' => true, 'placeholder' => 'Celular de Contacto..']) ?>
            </div>
            <div class="col-6"> 
                <?= $form->field($contacts_model, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Teléfono de Contacto..']) ?>
            </div>
        </div>
        <div class="row">            
            <div class="col-6"> 
                <?= $form->field($contacts_model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Correo Electrónico..']) ?>
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
            <div class="col-6">
                <div class="form-group">
                    <label for="dept_form">Departamento</label>
                    <select class="form-control" id="dept_form" onchange="deptsFunction(this.value)">
                        <option>Seleccionar Departamento..</option>
                        <?= $depts; ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'fk_municipality')->dropDownList($munic, ['prompt' => 'Seleccionar Municipio..']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Dirección..']) ?>
            </div>
        </div>
    </div>
    <div class ="p-3 border rounded bg-light">
        <div class="row border-bottom pb-2">
            <div class="col-12">
                <span class="h5">Clasificadores</span>
            </div>                
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <?= $form->field($model, 'cost_center_class')->dropDownList($class_cc, ['prompt' => 'Seleccionar Clase..']) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'group_class')->textInput(['maxlength' => true, 'placeholder' => 'Grupo..']) ?>
            </div>
        </div>
    </div>
    <div class ="p-3 border rounded bg-light">
        <div class="row border-bottom pb-2">
            <div class="col-12">
                <span class="h5">Vigencia</span>
            </div>                
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <?=
                $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Inicio de Vigencia..'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>
            <div class="col-6">
                <?=
                $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Fin de Vigencia..'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class ="p-3 border rounded bg-light">
        <div class="row border-bottom pb-2">
            <div class="col-12">
                <span class="h5">Categorías</span>
            </div>                
        </div>
        <div class="row pt-2">
            <div class="col-6">
                <?= $form->field($model, 'default_category')->dropDownList($categories, ['prompt' => 'Seleccionar Categoría..']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span>Lista de Categorías</span>

                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Cód. CC</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Nombre Corto</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Imágen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_cat_body">
                        <?php
                        if (!$model->isNewRecord) {
                            $i = 0;
                            foreach ($all_categories as $category) {
                                print "<tr id='category$i'>
                                    <td><input type='text' name='categ_code[]' id='categ_code$i' class='form-control' value='$category->cod_cc'></td>
                                    <td><input type='text' name='categ_name[]' id='categ_name$i' class='form-control' value='$category->name'></td>
                                    <td><input type='text' name='categ_short[]' id='categ_short$i' class='form-control' value='$category->short_name'></td>
                                    <td><input type='text' name='categ_type[]' id='categ_type$i' class='form-control' value='$category->type'></td>
                                    <td><input type='text' name='categ_manager[]' id='categ_manager$i' class='form-control' value='$category->manager'></td>
                                    <td><input type='text' name='categ_img[]' id='categ_img$i' class='form-control' value='$category->image'></td>
                                    <td><button class='btn btn-link' title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick='deleteCategory($i)'><i class='fas fa-trash-alt'></i></button></td>
                                </tr>";
                                $i++;
                            }
                            print "<input type='hidden' value='$i' id='count_categories'>";
                        }
                        ?>
                    </tbody>
                </table>
                <?= Html::button("+ Agregar Fila", ['class' => 'btn btn-primary float_right', 'onclick' => 'addCategory()']) ?>
            </div>
        </div>


    </div>




    <div class="form-group mt-3">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
