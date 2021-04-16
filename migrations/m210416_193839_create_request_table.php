<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m210416_193839_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->comment('наименование'),
            'category' => $this->integer()->comment('категория'),
            'content' => $this->text()->comment('тело запроса'),
            'date' => $this->timestamp()->comment('время запроса'),
            'status' => $this->integer()->comment('статус'),
            'data' => $this->json()->comment('массив с формализованными параметрами'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
