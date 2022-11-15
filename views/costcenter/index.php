<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CostcenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Costcenters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="costcenter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Costcenter', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'short_name',
            'manager',
            //'class_cc',
            //'group_class',
            //'start_date',
            //'end_date',
            //'fk_company',
            //'fk_headquarter',
            //'fk_cost_center',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
