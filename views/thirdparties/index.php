<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ThirdpartiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terceros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thirdparties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Tercero', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
//            'dv',
//            'doc_type',
            'name',
            //'tradename',
            //'visible',
            //'juridical',
            //'branch_office',
            //'photo',
            //'supplier',
            //'client',
            //'employee',
            //'seller',
            //'interested',
            //'associate',
            //'treatment',
            //'profession',
            //'company',
            //'appointment',
            //'genre',
            //'birthday',
            //'quick_code',
            //'processing_personal_data',
            //'transactional_info',
            //'promotional_info',
            //'fk_municipality',
            //'address',
            //'standard_supplier',
            //'payroll_entity_supplier',
            //'block_payments',
            //'payment_deadline',
            //'account_holder',
            //'account_number',
            //'account_bank',
            //'account_type',
            //'account_payment_method',
            //'alternate_code',
            //'class',
            //'additional_notes:ntext',
            //'fk_third',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {create}',
                'buttons' => [
                    'create' => function ($url, $model) {

                        return Html::a("<i class='fas fa-plus'></i>", $url, [
                            'title' => Yii::t('yii', 'Agregar Sucursal'),
                        ]);
                    }
                ],
            ]
        ],
    ]); ?>


</div>
