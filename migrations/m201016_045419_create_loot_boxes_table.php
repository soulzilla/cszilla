<?php

use app\components\core\Migration;

/**
* Class m201016_045419_create_loot_boxes_table
*/
class m201016_045419_create_loot_boxes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('loot_boxes', [
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

        $this->createIndex('index-name-canonical-loot-boxes', 'loot_boxes', 'name_canonical');

        $this->ts('loot_boxes');
        $this->isPublished('loot_boxes');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('loot_boxes');
    }
}
