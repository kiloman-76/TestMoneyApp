<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php
    if($message){
        ?>
        <p>
                <span>
                    <?= Html::encode("{$message}") ?>
                </span>
        </p>
        <?php
    }
    ?>
    <a href= <?echo Url::to(['/site/index']);?>>На главную</a>
</div>
