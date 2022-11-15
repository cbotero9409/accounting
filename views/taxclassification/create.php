<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxclassification */

$this->title = 'Create Taxclassification';
$this->params['breadcrumbs'][] = ['label' => 'Taxclassifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxclassification-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
