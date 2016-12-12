<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\LinkPager;

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
                <tr>
                    <td>

                    </td>
                    <td>
                        <?= Html::encode("{$operation->sender_mail}") ?>
                    </td>
                    <td>
                        <?= Html::encode("{$operation->money}") ?>
                    </td>
                    <td>
                        <?= Html::encode("{$operation->recipient_mail}") ?>
                    </td>
                    <td>
                        <?= Html::encode("{$operation->creator_mail}") ?>
                    </td>


                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <?= LinkPager::widget(['pagination' => $pagination]) ?>


    </div>

</div>
