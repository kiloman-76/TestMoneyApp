<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
?>
<div class="site-login">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните все поля, чтобы войти на сайт</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?php
                    if($model->login_error){
                        echo 'Вы не подтвердили ваш почтовый адрес!';
                    }
                ?>

                <?php echo $form->field($model, 'email')->textInput(['autofocus' => true])->label('Почтовый адрес') ?>

                <?php echo $form->field($model, 'password')->passwordInput()->label('Пароль') ?>



                <div class="form-group">
                    <?php echo Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
