<?php

use yii\db\Migration;

/**
 * Class m210416_175554_update_user_table
 */
class m210416_175554_update_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'institution_id', $this->integer());

        $this->createIndex('idx_user_institution_id', 'user', 'institution_id');
        $this->addForeignKey('fk_user_institution_id', 'user', 'institution_id', 'institution', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'institution_id');
    }

}
