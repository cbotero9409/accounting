<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Retentions */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Retenciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="retentions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar esta retención?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <div class="mb-5">

        <?=
        DetailView::widget([
                'model' => $model,                
                'attributes' => [
                'fk_parent_retention',                
                'code',
                'name',
                'validity_start',
                'obsolete',
                ],
        ])
        ?>

    </div>

    <div class="mb-5">

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'calculation_type',
                'value',
                'min_base_value',
                'auto_calculation',
            ],
        ])
        ?>

    </div>

    <div class="mb-3">

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'movement_type',
                'bill_to_pay',
                'how_affects',
                'payment_date_table',
                'third_party_alias',
                [
                'visible' => ($model->expense_account !== '' ? true : false),
                'attribute' => 'expense_account',
                'value' => $model->expense_account,
            ],
                [
                'visible' => ($model->cost_center !== '' ? true : false),
                'attribute' => 'cost_center',
                'value' => $model->cost_center,
            ],
            ],
        ])
        ?>

    </div>

</div>
