<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
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
                <td>Операции</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?$time_operation = date('d M Y H:i:s', $user->created_at);?>
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
