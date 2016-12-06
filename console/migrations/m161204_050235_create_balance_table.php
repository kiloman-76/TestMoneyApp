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
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('balance');
    }
}
