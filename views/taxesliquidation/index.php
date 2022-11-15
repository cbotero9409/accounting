<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaxesliquidationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Liquidación de Impuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxesliquidation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Concepto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'concept',
                'value' => function ($data) {
                    return $data->concept0->code . ' - ' . $data->concept0->name . ' (' . $data->concept0->validity_start . ')';
                }
            ],
            'observation',
            'price',
            'account_to_affect',
            'third_party',
            'cc_active',
            'payment_date',
            'fk_invoice',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
