<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserControl */

$this->title = 'Изменить данные пользователя ';
?>
<div class="user-control-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
