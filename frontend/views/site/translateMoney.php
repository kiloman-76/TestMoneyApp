<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Перевести деньги';
?>

<div class="site-about">

        <div class="row">
            <p>
                    <span class="header-page center-align">
                        Перевод денег
                    </span>
            </p>


            <span>Чтобы перевести деньги другому пользователю, укажите адрес его электронной почты, и денежную сумму, которую хотите перевести<br>
                    <b>Сумма не должна превышать имеющиеся у вас средства<b>
            </span>
        </div>

        <div class="row">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'add-money-form'
                ]
                ]); ?>
                    <p>
                        <span class="balance">
                            <?php echo Html::encode("Ваш баланс: {$balance} руб.") ?>
                        </span>
                    </p>
                <div class="row">
                    <div class="col-lg-5 ">
                        <?php echo $form->field($model, 'email')->textInput(['autofocus' => true])->label('Адрес получателя') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <?php echo $form->field($model, 'amount')->label('Сумма') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 form-group">
                        <?php echo Html::submitButton('Перечислить', ['class' => 'btn btn-index btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                </div>
            </div>



            <?php ActiveForm::end(); ?>




</div>
