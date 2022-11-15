<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Facturas de Compra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Factura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'fk_doc_type',
                'value' => function ($data) {
                    return Yii::$app->params['cash_bank']['movement_type'][$data->fk_doc_type];
                }
            ],
            'doc_number',
            [
                'attribute' => 'date',
                'value' => function ($data) {
                    return date('d-m-Y', strtotime($data->date));
                }
            ],
//            'class',
//            'fk_municipality',
            'detail',
            [
                'attribute' => 'cost_center',
                'value' => function ($data) {
                    return $data->costCenter->code . ' - ' . $data->costCenter->name;
                }
            ],
            [
                'attribute' => 'third_party',
                'value' => function ($data) {
                    return $data->thirdParty->code . ' - ' . $data->thirdParty->account;
                }
            ],
//            'reference',
            [
                'attribute' => 'total_price',
                'value' => function ($data) {
                    return '$ ' . number_format($data->total_price, 2, '.', ',');;
                }
            ],
//            'cash',
//            'account_cash',
//            'cash_payment_bank',
//            'bill_to_pay',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
