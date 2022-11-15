<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Contacto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
//            'person_type',
            'cell_phone',
            'phone',
            'email:email',
            'address',
            [
                'attribute' => 'fk_supplier',
                'format'=>'html',
                'value'=> function ($data) {
                    $supplier = app\models\Supplier::find()->select(['business_name'])->where(['id' => $data->fk_supplier])->one();
                    return $supplier->business_name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
