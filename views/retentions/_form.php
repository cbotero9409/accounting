<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Retentions */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/retentions.js');
?>

<div class="retentions-form col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6  mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <div class ="p-2 mb-4 border rounded bg-light">

        <?=
        $form->field($model, 'fk_parent_retention')->widget(Select2::classname(), [
            'data' => $retentions,
            'options' => ['placeholder' => 'Seleccionar...', 'onchange' => 'selectRetention(this)'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?=
        $form->field($model, 'validity_start')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Inicio de Vigencia ...'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
        ?>

    </div>

    <div class ="p-2 mb-4 border rounded bg-light">

        <?=
        $form->field($model, 'calculation_type')->widget(Select2::classname(), [
            'data' => $cal_type,
            'options' => ['placeholder' => 'Seleccionar Tipo de Cálculo...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'value')->textInput() ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'min_base_value')->textInput() ?> 
            </div>
        </div>


        <?= $form->field($model, 'auto_calculation')->checkbox() ?>

    </div>

    <div class ="p-2 mb-4 border rounded bg-light">

        <?=
        $form->field($model, 'movement_type')->widget(Select2::classname(), [
            'data' => $mov_type,
            'options' => ['placeholder' => 'Seleccionar Tipo de Movimiento...', 'onchange' => 'selectMove(this.value)'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?=
        $form->field($model, 'bill_to_pay')->widget(Select2::classname(), [
            'data' => $accounts,
            'options' => ['placeholder' => 'Seleccionar Cuenta...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?=
                $form->field($model, 'how_affects',
                        ['wrapperOptions' => ['style' => 'display:inline-block']])
                ->inline(true)->radioList($how_affects)
        ?>    

        <?=
        $form->field($model, 'payment_date_table')->widget(Select2::classname(), [
            'data' => $payment_table,
            'options' => ['placeholder' => 'Seleccionar Tabla...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?=
        $form->field($model, 'third_party_alias')->widget(Select2::classname(), [
            'data' => $third_id,
            'options' => ['placeholder' => 'Seleccionar Alias...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        <?php
        if ($model->movement_type == 1 || $model->movement_type == 2) {
            echo "<div id='payroll'>";
        } else {
            echo "<div id='payroll' class='d-none'>";
        }
        ?>

        <?=
        $form->field($model, 'expense_account')->widget(Select2::classname(), [
            'data' => $accounts,
            'options' => ['placeholder' => 'Seleccionar Cuenta...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?=
        $form->field($model, 'cost_center')->widget(Select2::classname(), [
            'data' => $cost_center,
            'options' => ['placeholder' => 'Seleccionar Centro de Costo...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    </div>

</div>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
