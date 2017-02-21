<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\models\User;

$this->title = $name;
?>
<div class="site-error">

    <div class="body-content">
        <h1>Операции</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Отправитель</td>
                    <td>Сумма</td>
                    <td>Получатель</td>
                    <td>Создатель</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($operations as $operation): ?>
                <?php $user = new User;?>
                <tr>
                    <td>

                    </td>
                    <td>
                        <?php echo Html::encode("{$user->getMail($operation->sender_id)}") ?>
                    </td>
                    <td>
                        <?php echo Html::encode("{$operation->money}") ?>
                    </td>
                    <td>
                        <?php echo Html::encode("{$user->getMail($operation->recipient_id)}") ?>
                    </td>
                    <td>
                        <?php echo Html::encode("{$user->getMail($operation->creator_id)}") ?>
                    </td>


                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <?php echo LinkPager::widget(['pagination' => $pagination]) ?>


    </div>

</div>
