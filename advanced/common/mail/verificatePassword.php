<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verificate-password', 'token' => $user->auth_key]);
?>
<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($user->email) ?>,</p>

    <p>Чтобы подтвердить свой почтовый адрес, перейдите по ссылке:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
