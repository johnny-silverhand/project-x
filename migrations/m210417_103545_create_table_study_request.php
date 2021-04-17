<?php

use yii\db\Migration;

/**
 * Class m210417_103545_create_table_study_request
 */
class m210417_103545_create_table_study_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%study_request}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100)->comment('ФИО абитуриента'),
            'birthdate' => $this->date()->comment('Дата рождения'),
            'institution_id' => $this->integer()->notNull()->comment('Ид учреждения'),
            'specialization_id' => $this->integer()->notNull()->comment('Ид направления'),
            'budget' => $this->boolean()->comment('Бюджет')->defaultValue(false),
            'orphan' => $this->boolean()->comment('Является сиротой')->defaultValue(false),
            'invalid' => $this->integer()->comment('Инвалидность'),
            'score' => $this->float()->comment('Средний балл'),
            'rate' => $this->smallInteger()->comment('Приоритет'),
            'with_docs' => $this->boolean()->comment('Предоставлены оригиналы документов')->defaultValue(false),
            'invited' => $this->boolean()->comment('Зачислен')->defaultValue(false),
        ]);

        $this->createIndex('idx_study_request_institution_id', '{{%study_request}}', 'institution_id');
        $this->addForeignKey('fk_study_request_institution_id', '{{%study_request}}', 'institution_id', 'institution', 'id', 'cascade', 'cascade');

        $this->createIndex('idx_study_request_specialization_id', '{{%study_request}}', 'specialization_id');
        $this->addForeignKey('fk_study_request_specialization_id', '{{%study_request}}', 'specialization_id', 'specialization', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%study_request}}');
    }
}
