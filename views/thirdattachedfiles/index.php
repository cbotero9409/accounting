<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ThirdattachedfilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thirdattachedfiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thirdattachedfiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Thirdattachedfiles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'file',
            'fk_third',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
