<?php

use app\components\core\Migration;

/**
* Class m210214_234652_create_related_news_table
*/
class m210214_234652_create_related_news_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('related_publications', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'publication_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-entity-id-related-news', 'related_publications', 'entity_id');
        $this->createIndex('index-entity-table-related-news', 'related_publications', 'entity_table');
        $this->createIndex('index-publication-id-related-news', 'related_publications', 'publication_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('related_publications');
    }
}
