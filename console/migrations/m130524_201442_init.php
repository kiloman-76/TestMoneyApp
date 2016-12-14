<?php
use yii\db\Expression;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string(32)->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'creation_date' => $this->date(),
            'role' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->execute($this->addUserSql());

    }

    private function addUserSql(){
        $auth_key = Yii::$app->security->generateRandomString();
        $date = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        return "INSERT INTO {{%user}} (`password`, `email`,  `auth_key`, `role`, `created_at`, `updated_at`) VALUES ('root', 'root@mail.ru', '$auth_key', 10, $date, $date )";
    }


    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
