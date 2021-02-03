<?php

use app\components\core\Migration;

/**
* Class m201112_180305_create_likes_table
*/
class m201112_180305_create_likes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('likes', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-user-id-likes', 'likes', 'user_id');
        $this->createIndex('index-entity-id-likes', 'likes', 'entity_id');
        $this->createIndex('index-entity-table-likes', 'likes', 'entity_table');
        $this->isDeleted('likes');
        $this->ts('likes');

        $this->createTable('views', [
            'id' => $this->primaryKey(),
            'entity_table' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'session_id' => $this->string()->notNull()
        ]);
        $this->ts('views');
        $this->createIndex('index-entity-id-views', 'views', 'entity_id');
        $this->createIndex('index-entity-table-views', 'views', 'entity_table');

        $this->createTable('ratings', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'rate' => $this->smallInteger()->notNull()
        ]);
        $this->createIndex('index-entity-id-ratings', 'ratings', 'entity_id');
        $this->createIndex('index-entity-table-ratings', 'ratings', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('views');
        $this->dropTable('likes');
        $this->dropTable('ratings');
    }
}
