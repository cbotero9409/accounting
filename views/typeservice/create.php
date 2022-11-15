<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TypeService */

$this->title = 'Create Type Service';
$this->params['breadcrumbs'][] = ['label' => 'Type Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
