<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Ordena';
?>

<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card card_login">
            <div class="card-header">
                <h3>Sign In</h3>
                <div class="d-flex justify-content-end social_icon">
                    <span><i class="fab fa-facebook-square"></i></span>
                    <span><i class="fab fa-google-plus-square"></i></span>
                    <span><i class="fab fa-twitter-square"></i></span>
                </div>
            </div>
            <div class="card-body">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                ]);
                ?>
                <div class="input-group form-group">
                    <div class="input-group-prepend form2">
                        <span class="input-group-text icon_login"><i class="fas fa-user"></i></span>
                    </div>
                    <!--<input type="text" class="form-control" placeholder="username">-->
                    <?=
                    $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control input_login', 'value' => 'santiago@gmail.com'])->label(false)
                    ?>
                </div>
                <div class="input-group form-group form1">
                    <div class="input-group-prepend form2 pb-3">
                        <span class="input-group-text icon_login"><i class="fas fa-key"></i></span>
                    </div>
                    <!--<input type="password" class="form-control" placeholder="password">-->
                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'class' => 'form-control input_login', 'value' => 'santiago'])->label(false) ?>
                </div>
                <div class="row align-items-center remember">
                        <!--<input type="checkbox">Remember Me-->
                    <?= $form->field($model, 'rememberMe')->checkBox(['selected' => $model->rememberMe]); ?>
                </div>
                <div class="form-group">
                        <!--<input type="submit" value="Login" class="btn float-right login_btn">-->
                    <?= Html::submitButton('Login', ['class' => 'btn float-right login_btn', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    Don't have an account?<a href="#">Sign Up</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#">Forgot your password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
