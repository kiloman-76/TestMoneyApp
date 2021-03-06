<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление денег';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-about">
    <div class="row">
        <p>
                 <span class="header-page center-align">
                    Зачисление денег
                </span>
        </p>
    </div>
    <p>
        <span class="balance">
                <?php echo Html::encode("Баланс пользователя: {$balance} руб.") ?>
        </span>
    </p>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-lg-4">
            <?php echo $form->field($model, 'amount')->label('Сумма') ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton('Перечислить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>