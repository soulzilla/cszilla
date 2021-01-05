<?php

use app\components\core\Migration;

/**
* Class m201018_041634_create_seo_table
*/
class m201018_041634_create_seo_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('seo', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'description' => $this->text(),
            'title' => $this->string(),
            'keywords' => $this->string(),
            'noindex' => $this->smallInteger()
        ]);

        $this->createIndex('index-entity-id-seo', 'seo', 'entity_id');
        $this->createIndex('index-entity-table-seo', 'seo', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('seo');
    }
}
