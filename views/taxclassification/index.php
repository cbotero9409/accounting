<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaxclassificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Taxclassifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxclassification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Taxclassification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fk_economic_activity',
            'tax_profile',
            'pn',
            'pj',
            //'pe',
            //'to1',
            //'ts',
            //'rs',
            //'rc',
            //'gc',
            //'av',
            //'ar',
            //'ag',
            //'nc',
            //'c1',
            //'c2',
            //'c3',
            //'ri',
            //'ee',
            //'ie',
            //'ed',
            //'ni',
            //'tax_administration',
            //'economic_clasification',
            //'declarant_class',
            //'iva',
            //'ic',
            //'iva_inc',
            //'does_not_apply',
            //'fk_company',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
