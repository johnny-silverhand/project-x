<?php

use yii\db\Migration;
use app\models\Institution;
use app\models\Specialization;

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
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull()->comment('Код специализации'),
            'institution_id' => $this->integer()->notNull()->comment('Ид учреждения'),
            'specialization_id' => $this->integer()->notNull()->comment('Ид направления'),
        ]);

        $this->createIndex('idx_group_institution_id', '{{%group}}', 'institution_id');
        $this->addForeignKey('fk_group_institution_id', '{{%group}}', 'institution_id', 'institution', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_group_specialization_id', '{{%group}}', 'specialization_id');
        $this->addForeignKey('fk_group_specialization_id', '{{%group}}', 'specialization_id', 'specialization', 'id', 'cascade', 'cascade');

        $institutions = Institution::find()->orderBy('id')->all();
        $specializations = Specialization::find()->orderBy('id')->all();
        foreach($institutions as $institution) {
            foreach($specializations as $specialization) {
                foreach([1,3,5,7] as $semester) {
                    $this->insert('{{%group}}', [
                        'code' => "$semester-{$institution->id}{$specialization->id}-1",
                        'institution_id' => $institution->id,
                        'specialization_id' => $specialization->id,
                     ]);
                }
            }
        }

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
            'group_id' => $this->integer()->notNull()->comment('ИД группы'),
        ]);

        $this->createIndex('idx_student_group_id', 'student', 'group_id');
        $this->addForeignKey('fk_student_group_id', 'student', 'group_id', '{{%group}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%student}}');
        $this->dropTable('{{%group}}');
    }
}
