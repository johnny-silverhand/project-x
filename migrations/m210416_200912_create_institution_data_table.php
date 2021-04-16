<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%institution_data}}`.
 */
class m210416_200912_create_institution_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%institution_data}}', [
            'id' => $this->primaryKey(),
            'institution_id' => $this->integer()->comment('ид института'),
            'category' => $this->integer()->comment('категория'),
            'name' => $this->string(50)->comment('наименование сведений'),
            'value' => $this->string(200)->comment('значение сведений'),
            'date' => $this->timestamp()->comment('время сбора данных'),
        ]);

        $this->createIndex('idx_institution_data_institution_id', 'institution_data', 'institution_id');
        $this->addForeignKey('fk_institution_data_institution_id', 'institution_data', 'institution_id', 'institution', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%institution_data}}');
    }
}
