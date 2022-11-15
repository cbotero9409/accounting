<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PayrolltaxesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Impuestos de Nómina';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payrolltaxes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Nómina', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'concept',
            'fk_chart_account',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
