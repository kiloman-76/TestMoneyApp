<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;
$this->title = 'Мои операции';
?>
<div class="site-page">
    <div class="row">
        <p><span class="header-page center-align">Ваши операции</span></p>
        <?php
            foreach($operations as $operation){
                $time_operation = date('d M Y H:i:s', $operation->operation_date);
                $user = new User;
                if($operation->sender_id == Yii::$app->user->id){?>

                    <?if($operation->creator_role == 'admin'){?>
                    <p><span class="operation-item red">
                            <?=Html::encode("С вашего счета отправлено {$operation->money} руб. пользователю {$user->getMail($operation->recipient_id)} {$time_operation}. Ваш баланс {$operation->sender_balance} руб."); ?>
                        </span></p>

                    <?
                } else if ($operation->creator_role != 'admin'){ ?>
                    <p><span class="operation-item red">
                        <?=Html::encode("Вы отправили {$operation->money} руб. пользователю {$user->getMail($operation->recipient_id)} {$time_operation}. Ваш баланс {$operation->sender_balance} руб.");?>
                    </span></p>
                    <?
                }
                ?>

                <?} else if ($operation->recipient_id == Yii::$app->user->id) {
                    if($operation->creator_role == 'admin'){?>
                        <p><span class="operation-item green">
                            <?=Html::encode("Вам начислено {$operation->money} руб.  {$time_operation}. Ваш баланс {$operation->recipient_balance} руб."); ?>
                        </span></p>

                        <?
                    } else if ($operation->creator_role != 'admin'){ ?>
                        <p><span class="operation-item green">
                            <?=Html::encode("Вам отправил {$operation->money} руб. пользователь {$user->getMail($operation->sender_id)} {$time_operation}. Ваш баланс {$operation->recipient_balance} руб."); ?>
                        </span></p>
                        <?
                    }
                    ?>

                <?}


            }
        ?>
    </div>
</div>