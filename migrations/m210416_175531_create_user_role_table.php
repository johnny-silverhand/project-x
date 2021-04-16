<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_role}}`.
 */
class m210416_175531_create_user_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_role}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'role_id' => $this->integer()->notNull()->comment('Роль'),
        ]);

        $this->addForeignKey('fk_user_role_user_id', 'user_role', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_user_role_user_id', 'user_role', 'user_id');

        $this->addForeignKey('fk_user_role_role_id', 'user_role', 'role_id', 'role', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_user_role_role_id', 'user_role', 'role_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_role}}');
    }
}
