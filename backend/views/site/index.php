<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\Operations;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">


        <p><a class="btn btn-lg btn-success" href=<?echo Url::to(['/site/add-user']);?>>Добавить пользователя</a>
       <a class="btn btn-lg btn-success" href=<?echo Url::to(['/site/operations']);?>>Список операций</a></p>
    </div>

    <div class="body-content">
        <h1>Пользователи</h1>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>#</td>
                <td>Email</td>
                <td>Баланс</td>
                <td>Дата создания</td>
                <td>Полученные средства</td>
                <td>Отправленные средства</td>
                <td>Операции</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?$time_operation = date('d M Y H:i:s', $user->created_at);?>
              <?
                $operation = new Operations();

                $taked_money = $operation -> takedMoney($user->id);
                $sended_money = $operation -> sendedMoney($user->id);
                ?>

                <tr>
                    <td>

                    </td>
                    <td>
                        <?= Html::encode("{$user->email}") ?>
                    </td>
                    <td>
                        <?= Html::encode("{$user->balance->balance}") ?>
                    </td>
                    <td>
                        <?= Html::encode("$time_operation") ?>
                    </td>
                    <td>
                        <?= Html::encode("$taked_money") ?>
                    </td>
                    <td>
                        <?= Html::encode("$sended_money") ?>
                    </td>
                    <td>
                        <a title="Просмотр" aria-label="Просмотр" href= <?echo Url::to(['/site/about-user','id' => $user->id]);?>>
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        <a title="Редактировать" aria-label="Редактировать" href= <?echo Url::to(['/user/update','id' => $user->id]);?>>
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a title="Зачислить деньги" aria-label="Зачислить деньги" href= <?echo Url::to(['/site/add-money','id' => $user->id]);?>>
                            <span class="glyphicon glyphicon-usd"></span>
                        </a>
                        <a title="Перевести деньги" aria-label="Перевести деньги" href= <?echo Url::to(['/site/send-money','id' => $user->id]);?>>
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </a>
                    </td>


                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <?= LinkPager::widget(['pagination' => $pagination]) ?>


    </div>
</div>
