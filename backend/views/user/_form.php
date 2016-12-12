<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserControl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-control-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>



    <?if($model->id != Yii::$app->user->id) { ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'role')->dropDownList([
                    '1' => 'Пользователь',
                    '10' => 'Администратор',
                ]); ?>
            </div>
        </div>

    <?
    }
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
