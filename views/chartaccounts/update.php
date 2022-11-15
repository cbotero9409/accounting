
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chartaccounts */

$this->title = 'Modificar Plan de Cuenta: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Planes de Cuenta', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="chartaccounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'accounts_types' => $accounts_types,
        'accounts_classes' => $accounts_classes,
        'taxes_conf_model' => $taxes_conf_model,
        'retentions' => $retentions,
        'taxes' => $taxes,
        'option_retentions' => $option_retentions,
        'all_concepts' => $all_concepts,
    ]) ?>

</div>
