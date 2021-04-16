<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specialization}}`.
 */
class m210416_180719_create_specialization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialization}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->comment('Код специализации'),
            'name' => $this->string()->comment('Наименование специализации'),
        ]);

        $this->batchInsert('{{%specialization}}', ['code', 'name'], [
            ["23.02.2003", "Техническое обслуживание и ремонт автомобильного транспорта"],
            ["26.08.07", "Технология продукции общественного питания"],
            ["35.02.12", "Садово-парковое и ландшафтное строительство"],
            ["35.02.03", "Технология деревообработки"],
            ["38.02.01", "Экономика и бухгалтерский учет"],
            ["40.02.01", "Право и организация социального обеспечения"],
            ["08.02.01", "Строительство и эксплуатация зданий и сооружений"],
            ["07.02.01", "Архитектура"],
            ["08.02.08", "Монтаж и эксплуатация оборудования и систем газоснабжения"],
            ["14.01.02", "Теплоснабжение и теплотехническое оборудование"],
            ["08.02.04", "Водоснабжение и водоотведение"],
            ["08.02.07", "Монтаж и эксплуатация оборудования внутренних сантехнических устройств и, кондиционирования воздуха и вентиляции"],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specialization}}');
    }
}