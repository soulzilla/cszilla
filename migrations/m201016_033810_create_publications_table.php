<?php

use app\components\core\Migration;

/**
* Class m201016_033810_create_publications_table
*/
class m201016_033810_create_publications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('publications', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'title_canonical' => $this->string()->notNull()->unique(),
            'body' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'publish_date' => $this->timestamp()->notNull()
        ]);

        $this->isPublished('publications');
        $this->isDeleted('publications');
        $this->isBlocked('publications');
        $this->ts('publications');

        $this->soundEx('publications', 'title');
        $this->phoneme('publications', 'title');
        $this->trigram('publications', 'title');

        $this->soundEx('publications', 'body');
        $this->phoneme('publications', 'body');
        $this->trigram('publications', 'body');

        $this->createIndex('index-title-canonical-publications', 'publications', 'title_canonical');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('publications');
    }
}
