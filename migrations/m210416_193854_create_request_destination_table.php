<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_destination}}`.
 */
class m210416_193854_create_request_destination_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_destination}}', [
            'id' => $this->primaryKey(),
            'request_id' => $this->integer()->comment('ид запроса'),
            'institution_id' => $this->integer()->comment('ид института'),
        ]);

        $this->createIndex('idx_request_destination_request_id', 'request_destination', 'request_id');
        $this->addForeignKey('fk_request_destination_request_id', 'request_destination', 'request_id', 'request', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_request_destination_institution_id', 'request_destination', 'institution_id');
        $this->addForeignKey('fk_request_destination_institution_id', 'request_destination', 'institution_id', 'institution', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_destination}}');
    }
}
