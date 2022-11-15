<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Chartaccounts */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Planes de Cuenta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="chartaccounts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de que desea eliminar este plan de cuenta?',
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
            'code',
            'account',
            'fk_account',
            'fk_account_type',
            'class',
            [
                'visible' => ($model->class == 'De Impuestos' ? true : false),
                'attribute' => 'fk_tax',
                'value' => $model->fk_tax,
            ],
        ],
    ])
    ?>

    <?php if (count($concepts) != 0) { ?>
        <div class="mt-5">
            <?php if ($model->class == 'De Nómina Contable') { ?>
                <table id="w1" class="table table-striped table-bordered detail-view">
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($concepts as $concept) {
                            echo "<tr>
                    <th> $i </th>                    
                    <td>$concept</td>
                </tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            <?php }
            ?>
        </div>
    <?php } ?>

    <div class="mt-5">
        <?php
        if ($model->class == 'Normal') {
            echo
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'visible' => ($taxes_conf->iva != null ? true : false),
                        'label' => 'IVA',
                        'value' => $taxes_conf->iva,
                    ],
                    [
                        'visible' => ($taxes_conf->retention != null ? true : false),
                        'label' => 'Retención',
                        'value' => $taxes_conf->retention,
                    ],
                    [
                        'visible' => ($taxes_conf->rete_ica != null ? true : false),
                        'label' => 'ReteICA',
                        'value' => $taxes_conf->rete_ica,
                    ],
                    [
                        'visible' => ($taxes_conf->tax_cree != null ? true : false),
                        'label' => 'Impuesto CREE',
                        'value' => $taxes_conf->tax_cree,
                    ],
                    [
                        'visible' => ($taxes_conf->auto_retention != null ? true : false),
                        'label' => 'Auto-Retención',
                        'value' => $taxes_conf->auto_retention,
                    ],
                    [
                        'visible' => ($taxes_conf->other != null ? true : false),
                        'label' => 'Otro Impuesto',
                        'value' => $taxes_conf->other,
                    ],
                    [
                        'visible' => ($taxes_conf->other_2 != null ? true : false),
                        'label' => 'Otro Impuesto 2',
                        'value' => $taxes_conf->other_2,
                    ],
                ],
            ]);
        }
        ?>
    </div>

    <div class="mt-5">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'handle_third_parties',
                'controls_indebtedness',
                'handle_references',
                'discriminate_by_third_party',
                'demands_base_value',
                'visible_in_selection',
                'local_account',
                'niif_account',
                'use_niif_equivalent_account',
            ],
        ])
        ?>
    </div>

</div>
