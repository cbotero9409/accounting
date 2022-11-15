<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaxesconfigurationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configuración de Impuestos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxesconfiguration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Configuración', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'iva',
            'retention',
            'rete_ica',
            'tax_cree',
            'auto_retention',
            'other',
            'other_2',
            'fk_chart_account',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
