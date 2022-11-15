<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanylabelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companylabel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'main_title') ?>

    <?= $form->field($model, 'mt_size') ?>

    <?= $form->field($model, 'mt_color') ?>

    <?= $form->field($model, 'subtitle') ?>

    <?php // echo $form->field($model, 'subt_size') ?>

    <?php // echo $form->field($model, 'subt_color') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'detail_size') ?>

    <?php // echo $form->field($model, 'detail_color') ?>

    <?php // echo $form->field($model, 'footer') ?>

    <?php // echo $form->field($model, 'footer_size') ?>

    <?php // echo $form->field($model, 'footer_color') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'header_type') ?>

    <?php // echo $form->field($model, 'fk_company') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
