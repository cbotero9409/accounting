<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Billofsale */

$this->title = $model->doc_number;
$this->params['breadcrumbs'][] = ['label' => 'Facturas de Venta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="billofsale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de que desea eliminar esta factura?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'attributes' => [
//            'id',
            'fk_doc_type',
            'doc_number',
            'date',
            [
                'visible' => ($model->class != null ? true : false),
                'attribute' => 'class',
            ],
            'fk_municipality',
            'detail',
            'cost_center',
            'client',
            'seller',
        ],
    ])
    ?>

    <div class="mt-5">
        <span class="h5">Lista de Ingresos</span>
        <table class="table table-striped">        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cuenta</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Centro de Costos</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $partial = 0;
                foreach ($incomes as $income) {
                    ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $income->fkChartAccount->code . ' - ' . $income->fkChartAccount->account ?></td>
                        <td><?= $income->concept ?></td>                    
                        <td><?= $income->fkCostCenter->code . ' - ' . $income->fkCostCenter->name ?></td>
                        <td><?= number_format($income->price, 2, '.', ',') ?></td>
                    </tr>
                    <?php
                    $i++;
                    $partial += $income->price;
                }
                ?>   
                <tr>
                    <th scope="row">Parcial:</th>
                    <td colspan="3"></td>
                    <td class="font-weight-bold"><?= '$ ' . number_format($partial, 2, '.', ',') ?></td>
                </tr>
            </tbody>        
        </table>
    </div>

    <div class="mt-5">
        <span class="h5">Liquidación de impuestos, descuentos y otros cargos</span>
        <table class="table table-striped">        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Valor Base</th>
                    <th scope="col">Porcentaje</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Afecta Cuenta</th>
                    <th scope="col">Tercero CXC</th>
                    <th scope="col">C.C/Activo</th>
                    <th scope="col">Fecha de Pago</th>
                    <th scope="col">Asiento</th>
                    <th scope="col">Valor Base Mínimo</th>
                    <th scope="col">Observación</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $j = 1;
                foreach ($taxes as $tax) {
                    ?>
                    <tr>
                        <th scope="row"><?= $j ?></th>
                        <td><?= $tax->concept0->code . ' - ' . $tax->concept0->name ?></td>
                        <td><?= number_format($tax->base_value, 2, '.', ',') ?></td>                    
                        <td><?= $tax->concept0->value . ' %' ?></td>
                        <td><?php
                            if ($tax->concept0->how_affects == 1) {
                                echo '-' . number_format($tax->price, 2, '.', ',');
                            } elseif ($tax->concept0->how_affects == 3) {
                                echo '+' . number_format($tax->price, 2, '.', ',');
                            } else {
                                echo number_format($tax->price, 2, '.', ',');
                            }
                            ?>
                        </td>
                        <td><?= $tax->accountToAffect->code . ' - ' . $tax->accountToAffect->account ?></td>
                        <td><?= $tax->thirdParty->code . ' - ' . $tax->thirdParty->account ?></td>
                        <td><?= $tax->cc_active ?></td>
                        <td><?= $tax->payment_date ?></td>
                        <td><?php
                            if ($tax->concept0->movement_type == 1) {
                                echo 'Crédito';
                            } elseif ($tax->concept0->movement_type == 2) {
                                echo 'Débito';
                            }
                            ?>
                        </td>
                        <td><?= number_format($tax->concept0->min_base_value, 2, '.', ','); ?></td>
                        <td><?= $tax->observation ?></td>
                    </tr>
                    <?php
                    $j++;
                }
                ?>   
                <tr>
                    <th scope="row">Total:</th>                    
                    <td class="font-weight-bold"><?= '$ ' . number_format($model->total_price, 2, '.', ',') ?></td>
                </tr>
                <tr>
                    <th scope="row">Referencia:</th>                    
                    <td><?= $model->reference ?></td>
                </tr>
            </tbody>        
        </table>
    </div>

    <div class="row mt-5">
        <span class="h5">Forma de Pago</span>        
        <?php
        if ($cash) {
            echo "<div class='col-$column border-right'>"
            ?>
            <table class="table table-striped">        
                <tbody>
                    <tr>
                        <th scope="row">Efectivo (caja)</th>                    
                        <td><?= '$ ' . number_format($model->cash, 2, '.', ',') ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Cuenta</th>                    
                        <td><?= $model->accountCash->code . ' - ' . $model->accountCash->account ?></td>                    
                    </tr>
                </tbody>
            </table>
            <?php
            echo "</div>";
        }
        ?>
        <?php
        if ($cash_bank) {
            echo "<div class='col-$column border-right'>"
            ?>
            <table class="table table-striped">        
                <tbody>
                    <tr>
                        <th scope="row">Contado (banco)</th>                    
                        <td><?= '$ ' . number_format($model->cash_payment_bank, 2, '.', ',') ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Cuenta</th>                    
                        <td><?php
                            if (isset($bank_model->bank_account)) {
                                echo $bank_model->bankAccount->code . ' - ' . $bank_model->bankAccount->account;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Tipo de Movimiento</th>                    
                        <td><?php
                            if (isset($bank_model->movement_type)) {
                                echo $bank_model->movement_type;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Número</th>                    
                        <td><?php
                            if (isset($bank_model->number)) {
                                echo $bank_model->number;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Fecha transacción</th>                    
                        <td><?php
                            if (isset($bank_model->date)) {
                                echo $bank_model->date;
                            }
                            ?></td>                    
                    </tr>
                </tbody>
            </table>
            <?php
            echo "</div>";
        }
        ?>
        <?php
        if ($cash_bill) {
            echo "<div class='col-$column border-right'>"
            ?>
            <table class="table table-striped">        
                <tbody>
                    <tr>
                        <th scope="row">Cuenta por Pagar</th>                    
                        <td><?= '$ ' . number_format($model->bill_to_pay, 2, '.', ',') ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Cuenta</th>                    
                        <td><?php
                            if (isset($bill_model->account)) {
                                echo $bill_model->account0->code . ' - ' . $bill_model->account0->account;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Pagar a</th>                    
                        <td><?php
                            if (isset($bill_model->third_party)) {
                                echo $bill_model->thirdParty->code . ' - ' . $bill_model->thirdParty->account;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Fecha de Pago</th>                    
                        <td><?php
                            if (isset($bill_model->date_to_pay)) {
                                echo $bill_model->date_to_pay;
                            }
                            ?></td>                    
                    </tr>
                    <tr>
                        <th scope="row">Cantidad de Cuotas</th>                    
                        <td><?php
                            if (isset($bill_model->number_of_fees)) {
                                echo $bill_model->number_of_fees;
                            }
                            ?></td>                    
                    </tr>
                </tbody>
            </table>
            <?php
            echo "</div>";
        }
        ?>
    </div>

    <div class="mt-5">
        <span class="h5">Datos Adicionales</span>
        <table class="table table-striped table-bordered detail-view">        
            <tbody>
                <tr>
                    <th scope="row">Tipo de Operación</th>                    
                    <td><?= $model->type_of_operation ?></td>                    
                </tr>
                <tr>
                    <th scope="row">N° Orden de Compra</th>                    
                    <td><?= $model->purchase_order_number ?></td>                    
                </tr>
                <tr>
                    <th scope="row">Observaciones</th>                    
                    <td><?= $model->observations ?></td>                    
                </tr>
                <tr>
                    <th scope="row">Archivos Adjuntos</th>                    
                    <td>
                        <?php
                        foreach ($files_model as $uploaded_file) {
                            echo Html::a($uploaded_file->file, ["uploads/bills_of_sale/$uploaded_file->file"], ['target' => '_blank']);
                            echo '</br>';
                        }
                        ?>
                    </td>                    
                </tr>
            </tbody>
        </table>
    </div>

</div>

