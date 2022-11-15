<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HeadquartersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Headquarters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="headquarters-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Headquarters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_company',
            'code',
            'name',
            'short_name',
            //'manager',
            //'fk_municipality',
            //'address',
            //'default_category',
            //'cost_center_class',
            //'group_class',
            //'start_date',
            //'end_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
