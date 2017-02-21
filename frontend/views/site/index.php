<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Тестовое приложение';
if( Yii::$app->user->isGuest){
?>
<div class="site-index">

    <div class="jumbotron">
        <h1 class="main-header">Добро пожаловать!</h1>

        <p class="lead">Чтобы получить доступ к денежным операциям, вам необходимо войти, или зарегистрироваться</p>

        <a class="btn btn-lg btn-success" href= <?php echo Url::to(['/site/login']);?>>Войти</a>
        <a class="btn btn-lg btn-success" href= <?php echo Url::to(['/site/signup']);?>>Зарегистрироваться</a></p>
    </div>


</div>
<?php } else{?>
    <div class="site-index">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span class="sub-header ">
                            <?php echo Html::encode("Ваш Баланс: {$balance} руб.") ?><br>
                        </span>

                        <span class="sub-header">
                            <?php echo Html::encode(" Всего отправлено денег: {$sended_money} руб.") ?><br>
                        </span>

                        <span class="sub-header">
                             <?php echo Html::encode(" Всего получено денег: {$taked_money} руб.") ?><br>
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><span class="sub-header center-align">Управление денежными операциями: </span><p>

                    <a class="btn btn-index btn-md btn-success" href=<?php echo Url::to(['/site/operations']);?>>Посмотреть все операции</a>
                    <a class="btn btn-index btn-md btn-success" href=<?php echo Url::to(['/site/translate-money']);?>>Сделать новый перевод </a>
                </div>
            </div>

    </div>
<?php }?>