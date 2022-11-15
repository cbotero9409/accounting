<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Nota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'note:ntext',
            'fk_users',
            'fk_supplier',
            'date',
            //'public',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
