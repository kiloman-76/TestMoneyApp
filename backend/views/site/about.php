<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Информация о пользователе';
$time_creation = date('d M Y H:i:s', $user->created_at);
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
        <div class="row">
            <p>
                    <span class="header-page center-align">
                        Информация о пользователе
                    </span>
            </p>
            <table border = '1' class = 'user-table'>
                <tr>
                    <td>Email:</td>
                    <td> <?=Html::encode("{$user->email}"); ?></td>
                </tr>
                <tr>
                    <td>Добавлен:</td>
                    <td><?=Html::encode("{$time_creation}"); ?></td>
                </tr>
                <tr>
                    <td>Баланс:</td>
                    <td><?=Html::encode("{$balance} руб."); ?></td>
                </tr>
            </table>
        </div>
        <div class="row">


            <p><span class="center-align sub-header">Операции пользователя</span></p>
            <?php
                foreach($operations as $operation){
                    $time_operation = date('d M Y H:i:s', $operation->operation_date);
                    if($operation->sender_id == $user->id){?>

                        <?if($operation->creator_role == 'admin'){?>
                        <p><span class="operation-item red">
                                <?=Html::encode("Переведено {$operation->money} руб. пользователю {$operation->recipient_mail} администратором {$operation->creator_mail} {$time_operation}. Баланс пользователя {$operation->sender_balance} руб."); ?>
                            </span></p>

                        <?
                    } else if ($operation->creator_role != 'admin'){ ?>
                        <p><span class="operation-item red">
                            <?=Html::encode("Отправлено {$operation->money} руб. пользователю {$operation->recipient_mail} {$time_operation}. Баланс пользователя {$operation->sender_balance} руб.");?>
                        </span></p>
                        <?
                    }
                    ?>

                    <?} else if ($operation->recipient_id == $user->id) {
                        if($operation->creator_role == 'admin'){
                            if($operation->sender_id){?>
                                <p><span class="operation-item green">
                                    <?=Html::encode("Переведено {$operation->money} руб. администратором {$operation->creator_mail} со счета пользователя {$operation->sender_mail} {$time_operation}. Баланс пользователя {$operation->recipient_balance} руб."); ?>
                                </span></p>
                                <?
                            } else {
                                ?>
                                    <p><span class="operation-item green">
                                        <?=Html::encode("Начислено {$operation->money} руб. администратором {$operation->creator_mail} {$time_operation}. Баланс пользователя {$operation->recipient_balance} руб."); ?>
                                    </span></p>
                                <?
                            }
                        } else if ($operation->creator_role != 'admin'){ ?>
                            <p><span class="operation-item green">
                                <?=Html::encode("Получено {$operation->money} руб. от пользователя {$operation->sender_mail} {$time_operation}. Баланс пользователя {$operation->recipient_balance} руб."); ?>
                            </span></p>
                            <?
                        }
                        ?>

                    <?}


                }
            ?>
        </div>
    </div>
<?}?>