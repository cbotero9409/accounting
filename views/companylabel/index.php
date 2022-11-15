<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanylabelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companylabels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companylabel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companylabel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'main_title',
            'mt_size',
            'mt_color',
            'subtitle',
            //'subt_size',
            //'subt_color',
            //'detail',
            //'detail_size',
            //'detail_color',
            //'footer',
            //'footer_size',
            //'footer_color',
            //'logo',
            //'header_type',
            //'fk_company',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
