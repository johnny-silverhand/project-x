<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%response_file}}`.
 */
class m210416_193923_create_response_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%response_file}}', [
            'id' => $this->primaryKey(),
            'response_id' => $this->integer()->comment('ид ответа'),
            'type' => $this->string()->comment('mime'),
            'content' => $this->text()->comment('контент файла'),
        ]);

        $this->createIndex('idx_response_file_response_id', 'response_file', 'response_id');
        $this->addForeignKey('fk_response_file_response_id', 'response_file', 'response_id', 'response', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%response_file}}');
    }
}
