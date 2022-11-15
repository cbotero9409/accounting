<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Taxes */

$this->title = 'Agregar Impuesto';
$this->params['breadcrumbs'][] = ['label' => 'Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'type' => $type,
    ])
    ?>

</div>
