<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CashbankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transacciones Banco';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cashbank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Transacción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'bank_account',
                'value' => function ($data) {
                    return $data->bankAccount->code . ' - ' . $data->bankAccount->account;;
                }
            ],
            [
                'attribute' => 'movement_type',
                'value' => function ($data) {
                    return Yii::$app->params['cash_bank']['movement_type'][$data->movement_type];
                }
            ],
            'number',
            'date',
            'fk_invoice',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
