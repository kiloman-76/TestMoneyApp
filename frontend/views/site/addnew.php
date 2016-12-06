<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <div class="jumbotron">
        <div class="row">
            <p>
                        <span>
                            <?= Html::encode("Ваш Баланс: {$balance} руб.") ?>
                        </span>
            </p>
            <p>
                    <span>
                        Перевод денег
                    </span>
            </p>
            <span>Чтобы перевести деньги другому пользователю, укажите адрес его электронной почты, и денежную сумму, которую хотите перевести<br>
                    <b>Сумма не должна превышать имеющиеся у вас средства<b>
            </span>
        </div>


            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-2">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Адрес получателя') ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model, 'amount')->label('Сумма') ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Перечислить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>


            <?php ActiveForm::end(); ?>



    </div>
</div>
