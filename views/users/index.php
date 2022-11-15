<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'document',
            //'birthday',
            'phone',
            //'address',
            //'fk_municipality',
            //'gender',
            //'occupation',
            //'user_type',
            'email:email',
            //'password',
            //'photo',
            //'last_date',
            [
                'format'=>'html',
                'contentOptions' => ['style' => 'text-align:center'],
                'value'=> function ($data) {
                    $img_path = '../img/' . $data->photo;
                    return Html::img($img_path, ['height'=>'80px']);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:20px'],
                ],
        ],
    ]); ?>


</div>
