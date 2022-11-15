<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Chartaccounts */

$this->title = 'Agregar Plan de Cuenta';
$this->params['breadcrumbs'][] = ['label' => 'Planes de Cuenta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chartaccounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'accounts' => $accounts,
        'accounts_types' => $accounts_types,
        'accounts_classes' => $accounts_classes,
        'taxes_conf_model' => $taxes_conf_model,
        'retentions' => $retentions,
        'taxes' => $taxes,
        'option_retentions' => $option_retentions,
        'all_concepts' => $all_concepts,
        'option_accounts' => $option_accounts,
        'account_id' => $account_id,
    ])
    ?>

</div>
