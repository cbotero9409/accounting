<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomelistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Incomelists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomelist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Incomelist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_chart_account',
            'concept',
            'price',
            'fk_cost_center',
            //'fk_bill',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
