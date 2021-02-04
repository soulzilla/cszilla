<?php

use app\components\core\Migration;

/**
* Class m201016_045355_create_casinos_table
*/
class m201016_045355_create_casinos_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('casinos', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_canonical' => $this->string()->notNull()->unique(),
            'logo' => $this->text(),
            'description' => $this->text()->notNull(),
            'pros' => $this->text(),
            'cons' => $this->text(),
            'order' => $this->integer()->unique(),
            'currencies' => $this->text(),
            'payment_methods' => $this->text(),
            'website' => $this->string()->notNull(),
            'recommended' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->createIndex('index-name-canonical-casinos', 'casinos', 'name_canonical');

        $this->ts('casinos');
        $this->isPublished('casinos');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('casinos');
    }
}
