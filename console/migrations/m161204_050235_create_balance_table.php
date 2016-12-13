<?php

use yii\db\Migration;

/**
 * Handles the creation of table `balance`.
 */
class m161204_050235_create_balance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%balance}}', [
            'id' => $this->primaryKey(),
            'balance' => $this->decimal(),
            'user_id' => $this->integer()
        ]);

        $this->createIndex('idx_id_user', '{{%balance}}', 'user_id');
        $this->addForeignKey(
            'fk_id_user', '{{%balance}}', 'user_id', '{{%user}}', 'id', 'CASCADE'
        );
        $this->execute($this->addUserSql());
    }

    private function addUserSql(){
        $auth_key = Yii::$app->security->generateRandomString();
        $date = Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
        return "INSERT INTO {{%balance}} (`balance`,`user_id`) VALUES (0,1)";
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('balance');
    }
}
