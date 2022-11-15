<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Billsattachedfiles */

$this->title = 'Create Billsattachedfiles';
$this->params['breadcrumbs'][] = ['label' => 'Billsattachedfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billsattachedfiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
