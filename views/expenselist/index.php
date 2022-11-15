<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExpenselistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Gastos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenselist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar elemento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'fk_chart_account',
                'value' => function ($data) {
                    return $data->fkChartAccount->code . ' - ' . $data->fkChartAccount->account;
                }
            ],
//            'concept',
            'price',
            [
                'attribute' => 'fk_cost_center',
                'value' => function ($data) {
                    return $data->fkCostCenter->code . ' - ' . $data->fkCostCenter->name;
                }
            ],
            'fk_inovice',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
