<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categorylist */

$this->title = 'Create Categorylist';
$this->params['breadcrumbs'][] = ['label' => 'Categorylists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorylist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
