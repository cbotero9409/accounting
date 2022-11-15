<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'fk_users') ?>

    <?= $form->field($model, 'fk_supplier') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'public') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
