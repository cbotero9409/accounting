<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaxclassificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="taxclassification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fk_economic_activity') ?>

    <?= $form->field($model, 'tax_profile') ?>

    <?= $form->field($model, 'pn') ?>

    <?= $form->field($model, 'pj') ?>

    <?php // echo $form->field($model, 'pe') ?>

    <?php // echo $form->field($model, 'to1') ?>

    <?php // echo $form->field($model, 'ts') ?>

    <?php // echo $form->field($model, 'rs') ?>

    <?php // echo $form->field($model, 'rc') ?>

    <?php // echo $form->field($model, 'gc') ?>

    <?php // echo $form->field($model, 'av') ?>

    <?php // echo $form->field($model, 'ar') ?>

    <?php // echo $form->field($model, 'ag') ?>

    <?php // echo $form->field($model, 'nc') ?>

    <?php // echo $form->field($model, 'c1') ?>

    <?php // echo $form->field($model, 'c2') ?>

    <?php // echo $form->field($model, 'c3') ?>

    <?php // echo $form->field($model, 'ri') ?>

    <?php // echo $form->field($model, 'ee') ?>

    <?php // echo $form->field($model, 'ie') ?>

    <?php // echo $form->field($model, 'ed') ?>

    <?php // echo $form->field($model, 'ni') ?>

    <?php // echo $form->field($model, 'tax_administration') ?>

    <?php // echo $form->field($model, 'economic_clasification') ?>

    <?php // echo $form->field($model, 'declarant_class') ?>

    <?php // echo $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'ic') ?>

    <?php // echo $form->field($model, 'iva_inc') ?>

    <?php // echo $form->field($model, 'does_not_apply') ?>

    <?php // echo $form->field($model, 'fk_company') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
