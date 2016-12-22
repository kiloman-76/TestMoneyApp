<?php

use yii\db\Migration;

class m161220_170639_add_user_data extends Migration
{
    public function safeUp()
    {
        $auth_key = Yii::$app->security->generateRandomString();
        $date = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        Yii::$app->db->createCommand()->insert('user', [
       'password' => 'password', 'email' =>'root1@mail.ru',  'auth_key' => $auth_key, 'role' => 10, 'created_at'=> $date, 'updated_at'=>$date])->execute();
        Yii::$app->db->createCommand()->insert('balance', ['balance' => '0', 'user_id' =>'1'])->execute();
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('news', ['id' => 1]);
        Yii::$app->db->createCommand()->delete('balance', ['user_id' => 1]);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
