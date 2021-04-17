<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m210416_181242_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100)->comment('ФИО Студента'),
            'birthdate' => $this->date()->comment('Дата рождения'),
            'budget' => $this->boolean()->comment('Бюджет'),
            'date_start' => $this->date()->comment('Дата начала обучения'),
            'date_end' => $this->date()->comment('Дата конца обучения'),
            'status' => $this->integer('Статус обучения'),
            'orphan' => $this->boolean()->comment('признак сироты'),
            'invalid' => $this->integer('инвалидность'),
            'employed' => $this->boolean()->comment('трудоустроен после окончания'),
            'institution_id' => $this->integer()->comment('ИД Организации'),
            'specialization_id' => $this->integer()->comment('ИД Специализации'),
        ]);

        $this->createIndex('idx_student_institution_id', 'student', 'institution_id');
        $this->addForeignKey('fk_student_institution_id', 'student', 'institution_id', 'institution', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_student_specialization_id', 'student', 'specialization_id');
        $this->addForeignKey('fk_student_specialization_id', 'student', 'specialization_id', 'specialization', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
    }
}
