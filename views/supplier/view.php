<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/supplierNotes.js');
$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/supplierContacts.js');

$this->title = $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\Supplier */
?>
<div class="supplier-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de eliminar el proveedor?',
                'method' => 'post',
            ],
        ])
        ?>           
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'business_name',
            'nit',
            'phone',
            'address',
            'supplier_type',
        ],
    ])
    ?>

</div>

<div id="accordion">
    <div class="card">
        <div class="card-header" id="contacts_supplier">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseContacts" aria-expanded="false" aria-controls="collapseContacts">
                    Contactos
                </button>
            </h5>
        </div>
        <div id="collapseContacts" class="collapse" aria-labelledby="heading_contacts" data-parent="#accordion">
            <div class="card-body">  
                <table class="table table-striped">
                    <thead>
                        <tr>                
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo de Persona</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Dirección</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="db_contacts">
                        <?php foreach ($contact as $cont) { ?>                    
                            <tr id='contact<?= $cont->id ?>'>
                                <?= "<td>$cont->name</td>
                                <td>$cont->person_type</td>
                                <td>$cont->cell_phone</td>
                                <td>$cont->phone</td>
                                <td>$cont->email</td>
                                <td>$cont->address</td>" ?>
                                <td class="inline_flex">                                    
                                    <button class="btn btn-link" value='viewcontact?id_contact=<?= $cont->id ?>' title='Modificar' aria-label='Modificar'data-pjax='0' onclick='modalContacts(this.value)'><i class='fas fa-pencil-alt'></i></button>
                                    <button class="btn btn-link" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteContact(<?= $cont->id ?>)"><i class='fas fa-trash-alt'></i></button>
                                </td>
                            </tr>                        
                        <?php } ?>            
                    </tbody>
                </table>
                <?= Html::button('+ Agregar Contacto', ['value' => Url::to("createcontact"), 'class' => 'btn btn-primary', 'onclick' => "modalContacts(this.value)"]); ?>
            </div>
        </div>
        <div class="modal fade" id="contactsModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="contacts_modal_content">

                </div>
            </div>
        </div>
    </div>    
    <div class="card">
        <div class="card-header" id="notes_supplier">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNotes" aria-expanded="false" aria-controls="collapseNotes">
                    Notas
                </button>
            </h5>
        </div>
        <div id="collapseNotes" class="collapse" aria-labelledby="heading_notes" data-parent="#accordion">
            <div class="card-body">
                <?php if (count($notes) > 0) { ?>
                    <div id='db_notes'>
                        <?php
                        foreach ($notes as $note) {
                            if ($note->public === 1) {
                                $public = ' (Pública)';
                            } else {
                                $public = '';
                            }
                            ?>
                            <div class='row my-2 p-4 border rounded bg-light' id="note<?= $note->id ?>">
                                <div class='col-12'>
                                    <div class='row'>
                                        <div class='col-12'>                                
                                            <?= $note->date ?>
                                            <span class='text-warning notes_public'>&nbsp<?= $public ?></span>  
                                            <button class="btn btn-link float_right" title='Eliminar' aria-label='Eliminar'data-pjax='0' onclick="deleteNote(<?= $note->id ?>)"><i class='fas fa-trash-alt'></i></button> 
                                            <button class="btn btn-link float_right" value='viewnote?id_note=<?= $note->id ?>' title='Modificar' aria-label='Modificar'data-pjax='0' onclick="modalNotes(this.value)"><i class='fas fa-pencil-alt'></i></button>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-12'>
                                            <?= $note->note ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?php if (count($public_notes) > 0) { ?>
                    <div id="public_notes" class="mt-4 py-3 border-top">
                        <span class="font-weight-bold">Notas de otros usuarios:</span>
                        <?php
                        foreach ($public_notes as $public_note) {
                            ?>
                            <div class='row my-2 p-4 border rounded bg-light' id="note<?= $public_note->id ?>">
                                <div class='col-12'>
                                    <div class='row'>
                                        <div class='col-12'>                                
                                            <?= $public_note->date ?>                                            
                                        </div>
                                    </div>
                                    <div class='row mt-3'>
                                        <div class='col-12'>
                                            <?= $public_note->note ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <?= Html::button('+ Nota Nueva', ['value' => Url::to("createnote"), 'class' => 'btn btn-primary', 'onclick' => "modalNotes(this.value)"]); ?>                
            </div>
        </div>

        <div class="modal fade" id="notesModal" tabindex="-1" aria-labelledby="notesModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id='notes_modal_content'>                    

                </div>
            </div>
        </div>
        <input type="hidden" id="supplier_id" name="supplier_id" value='<?= $model->id ?>'>
    </div>
</div>
