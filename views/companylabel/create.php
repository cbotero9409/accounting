<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companylabel */

$this->title = 'Create Companylabel';
$this->params['breadcrumbs'][] = ['label' => 'Companylabels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companylabel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
