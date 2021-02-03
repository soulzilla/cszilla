<?php

use app\components\core\Migration;

/**
* Class m201202_181350_create_comments_table
*/
class m201202_181350_create_comments_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'content' => $this->text()->notNull()
        ]);

        $this->ts('comments');
        $this->isBlocked('comments');
        $this->isDeleted('comments');

        $this->createIndex('index-user-id-comments', 'comments', 'user_id');
        $this->createIndex('index-entity-id-comments', 'comments', 'entity_id');
        $this->createIndex('index-entity-table-comments', 'comments', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
