<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductslinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productslines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productslines-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Productslines', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'line',
            'fk_third',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
