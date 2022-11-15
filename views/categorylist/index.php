<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorylistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorylists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorylist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categorylist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cod_cc',
            'name',
            'short_name',
            'type',
            //'manager',
            //'image',
            //'fk_headquarter',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
