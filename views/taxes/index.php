<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaxesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Impuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Impuesto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'tax',
            'type',
            'value',
            'year',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
