<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Taxclassification */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Taxclassifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="taxclassification-view">

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
            'fk_economic_activity',
            'tax_profile',
            'pn',
            'pj',
            'pe',
            'to1',
            'ts',
            'rs',
            'rc',
            'gc',
            'av',
            'ar',
            'ag',
            'nc',
            'c1',
            'c2',
            'c3',
            'ri',
            'ee',
            'ie',
            'ed',
            'ni',
            'tax_administration',
            'economic_clasification',
            'declarant_class',
            'iva',
            'ic',
            'iva_inc',
            'does_not_apply',
            'fk_company',
        ],
    ]) ?>

</div>
