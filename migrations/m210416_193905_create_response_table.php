<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%response}}`.
 */
class m210416_193905_create_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%response}}', [
            'id' => $this->primaryKey(),
            'request_id' => $this->integer()->comment('ид запроса'),
            'institution_id' => $this->integer()->comment('ид института'),
            'date' => $this->timestamp()->comment('время сбора данных'),
            'content' => $this->text()->comment('тело ответа'),
            'data' => $this->json()->comment('массив с формализованными параметрами'),
        ]);

        $this->createIndex('idx_response_request_id', 'response', 'request_id');
        $this->addForeignKey('fk_response_request_id', 'response', 'request_id', 'request', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_response_institution_id', 'response', 'institution_id');
        $this->addForeignKey('fk_response_institution_id', 'response', 'institution_id', 'institution', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%response}}');
    }
}
