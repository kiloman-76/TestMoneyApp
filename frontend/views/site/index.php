<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
if( Yii::$app->user->isGuest){
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        <?php
        ?>
        <p class="lead">Чтобы получить доступ к денежным операциям, вам необходимо войти, или зарегистрироваться</p>

        <a class="btn btn-lg btn-success" href= <?echo Url::to(['/site/login']);?>>Войти</a>
        <a class="btn btn-lg btn-success" href= <?echo Url::to(['/site/signup']);?>>Зарегистрироваться</a></p>
    </div>


</div>
<?} else{?>
    <div class="site-index">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span>
                            <?= Html::encode("Ваш Баланс: {$balance} руб.") ?>
                        </span>
                    </p>
                    <p>
                        <span>
                            <?= Html::encode(" Всего отправлено денег: {$sended_money} руб.") ?>


                        </span>
                    </p>
                    <p>
                        <span>
                             <?= Html::encode(" Всего получено денег: {$taked_money} руб.") ?>


                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><span>Управление денежными операциями: </span><p>

                    <a class="btn btn-md btn-success" href="#">Посмотреть все операции</a>
                    <a class="btn btn-md btn-success" href=<?echo Url::to(['/site/addnew']);?>>Сделать новый перевод </a>
                </div>
            </div>

        </div>
    </div>
<?}?>