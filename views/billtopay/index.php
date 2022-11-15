<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BilltopaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas por Pagar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billtopay-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Cuenta', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'third_party',
                'value' => function ($data) {
                    return $data->thirdParty->code . ' - ' . $data->thirdParty->account;
                    ;
                }
            ],
            [
                'attribute' => 'account',
                'value' => function ($data) {
                    return $data->account0->code . ' - ' . $data->account0->account;
                    ;
                }
            ],
            'date_to_pay',
            'number_of_fees',
            'fk_inovice',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
