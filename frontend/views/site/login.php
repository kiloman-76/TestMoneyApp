<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, заполните все поля, чтобы войти на сайт</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?
                    if($model->login_error){
                        echo 'Вы не подтвердили ваш почтовый адрес!';
                    }
                ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Почтовый адрес') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>



                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
