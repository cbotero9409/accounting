<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventoryitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventoryitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventoryitems-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Inventoryitems', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_item',
            'code',
            'unit',
            'price',
            //'date',
            //'last_price',
            //'last_date',
            //'fk_third',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
