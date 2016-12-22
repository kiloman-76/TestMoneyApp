<?php

use yii\db\Migration;

/**
 * Handles the creation of table `operations`.
 */
class m161204_135450_create_operations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%operations}}', [
            'id' => $this->primaryKey(),
            'money' => $this->decimal(10,2),
            'sender_id' => $this->integer(),
            'sender_balance' => $this->decimal(10,2),
            'recipient_id' => $this->integer(),
            'recipient_balance' => $this->decimal(10,2),
            'operation_date' => $this->integer()->notNull(),
            'creator_role' => $this->string(5),
            'creator_id' => $this->integer()
        ]);

        $this->createIndex('idx_id_sender', '{{%operations}}', 'sender_id');
        $this->addForeignKey(
            'fk_id_sender', '{{%operations}}', 'sender_id', '{{%user}}', 'id', 'CASCADE'
        );

        $this->createIndex('idx_id_recipient', '{{%operations}}', 'recipient_id');
        $this->addForeignKey(
            'fk_id_recipient', '{{%operations}}', 'recipient_id', '{{%user}}', 'id', 'CASCADE'
        );

        $this->createIndex('idx_id_creator', '{{%operations}}', 'creator_id');
        $this->addForeignKey(
            'fk_id_creator', '{{%operations}}', 'creator_id', '{{%user}}', 'id', 'CASCADE'
        );
    }



    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('operations');
    }
}
