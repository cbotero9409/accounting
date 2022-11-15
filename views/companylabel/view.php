<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companylabel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companylabels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="companylabel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'main_title',
            'mt_size',
            'mt_color',
            'subtitle',
            'subt_size',
            'subt_color',
            'detail',
            'detail_size',
            'detail_color',
            'footer',
            'footer_size',
            'footer_color',
            'logo',
            'header_type',
            'fk_company',
        ],
    ]) ?>

</div>
