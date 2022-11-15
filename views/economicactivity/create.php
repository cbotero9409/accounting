<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Economicactivity */

$this->title = 'Create Economicactivity';
$this->params['breadcrumbs'][] = ['label' => 'Economicactivities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="economicactivity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
