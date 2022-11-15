<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BillsattachedfilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Billsattachedfiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billsattachedfiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Billsattachedfiles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file',
            'fk_bill_of_sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
