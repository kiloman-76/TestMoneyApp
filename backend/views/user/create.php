<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserControl */

$this->title = 'Create User Control';
$this->params['breadcrumbs'][] = ['label' => 'User Controls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-control-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
