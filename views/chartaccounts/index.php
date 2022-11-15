<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChartaccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planes de Cuenta';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chartaccounts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Plan de Cuenta', ['create', 'id' => 'new'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'rowOptions' => function ($model, $key, $index, $grid) {
            // $model is the current data model being rendered
            // check your condition in the if like `if($model->hasMedicalRecord())` which could be a method of model class which checks for medical records.
            if (strlen($model->code) == 1) {
                return ['class' => 'ch_row_1'];
            } elseif (strlen($model->code) == 2) {
                return ['class' => 'ch_row_2'];
            } elseif (strlen($model->code) == 4) {
                return ['class' => 'ch_row_3'];
            } elseif (strlen($model->code) == 6) {
                return ['class' => 'ch_row_4'];
            }
            return [];
        },
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'code',
            'account',
//            'fk_account',
//            [
//                'label' => 'Cuenta Equivalente',
//                'attribute' => 'fk_account',
//                'value' => 'fkAccount.code'
//            ],
//            'fk_account_type',
            [
                'label' => 'Tipo de Cuenta',
                'attribute' => 'fk_account_type',
                'value' => 'fkAccountType.type'
            ],
//            'class',
            [
                'label' => 'Clase de Cuenta',
                'attribute' => 'class',
                'value' => function ($data) {
                    return Yii::$app->params['account_classes'][$data->class];
                }
            ],
//            'handle_third_parties',
//            'controls_indebtedness',
//            'handle_references',
//            'discriminate_by_third_party',
//            'demands_base_value',
//            'visible_in_selection',
//            'local_account',
//            'niif_account',            
//            'use_niif_equivalent_account',  
//            'fk_tax',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {create}',
                'buttons' => [
                    'create' => function ($url, $model) {

                        return Html::a("<i class='fas fa-plus'></i>", $url, [
                            'title' => Yii::t('yii', 'Create'),
                        ]);
                    }
                ],
            ]
        ],
    ]);
    ?>

</div>
