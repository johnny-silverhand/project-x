<?php

use yii\db\Migration;

/**
 * Class m210416_175543_create_institution
 */
class m210416_175543_create_institution_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%institution}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->comment('наименование'),
            'is_admin' => $this->boolean()->defaultValue(false)->comment(''),
        ]);

        $this->batchInsert('{{%institution}}', ['name', 'is_admin'], [
            ['Асиновский техникум промышленной индустрии и сервиса', false],
            ['Каргасокский техникум промышленности и речного транспорта', false],
            ['Северский промышленный колледж', false],
            ['Томский аграрный колледж', false],
            ['Томский базовый медицинский колледж', false],
            ['Томский индустриальный техникум', false],
            ['Томский техникум информационных технологий', false],
            ['Томский техникум социальных технологий', false],
            ['Департамент профессионального образования Томской области', true],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%institution}}');
    }

}
