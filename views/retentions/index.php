<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RetentionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Retenciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retentions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Retención', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            [
//        'label' => 'Cuenta Equivalente',
//        'attribute' => 'fk_parent_retention',
//        'value' => 'fkParentRetention.code'
//    ],
            'code',
            'name',
//            [
//        'attribute' => 'validity_start',
//        'value' => function ($data) {        
//                return date('d-m-Y', strtotime($data->validity_start));
//        }
//    ],
            //'calculation_type',
            [
        'attribute' => 'value',
        'value' => function ($data) {        
                if ($data->calculation_type != 1) {
            $data->value = number_format(floatval($data->value), 2, ",", ".");
        } else {
            $data->value = "$data->value%";
        }
        return $data->value;
        }
    ],
            [
        'attribute' => 'min_base_value',
        'value' => function ($data) {        
                return number_format(floatval($data->min_base_value), 2, ",", ".");
        }
    ],
            //'auto_calculation',
            //'movement_type',
            //'bill_to_pay',
            //'how_affects',
            //'payment_date_table',
            //'third_party_alias',
            //'expense_account',
            //'cost_center',
//            'obsolete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
