<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PurchasedproductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchasedproducts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchasedproducts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Purchasedproducts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'product',
            'unit',
            'date',
            //'doc_number',
            //'price',
            //'movement_type',
            //'fk_third',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
