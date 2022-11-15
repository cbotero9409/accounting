<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Taxesconfiguration */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configuración de Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="taxesconfiguration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro de que desea eliminar esta configuración?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'iva',
                'value' => $iva,
        ],
            [
                'attribute' => 'retention',
                'value' => $retention,
            ],
            [
                'attribute' => 'rete_ica',
                'value' => $rete_ica,
            ],
            [
                'attribute' => 'tax_cree',
                'value' => $tax_cree,
            ],
            [
                'attribute' => 'auto_retention',
                'value' => $auto_retention,
            ],
            [
                'attribute' => 'other',
                'value' => $other,
            ],
            [
                'attribute' => 'other_2',
                'value' => $other_2,
            ],
            'fk_chart_account',
        ],
    ]) ?>

</div>
