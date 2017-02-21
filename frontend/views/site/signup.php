<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';


?>
<div class="site-signup">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php
    if($message){
        ?>
        <p>
                <span>
                    <?php echo Html::encode("{$message}") ?>
                </span>
        </p>
        <?php
    }
    ?>
    <p>Пожалуйста, заполните все поля, чтобы зарегистрироваться</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?php echo $form->field($model, 'email')->label('Почтовый адрес') ?>

                <?php echo $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                <?php echo $form->field($model, 'confirm')->passwordInput()->label('Подтвердите пароль') ?>

                <div class="form-group">
                    <?php echo Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
