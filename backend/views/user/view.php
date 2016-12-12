<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserControl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Controls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-control-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'role',
            'is_admin',
            'created_at',
            'updated_at',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
