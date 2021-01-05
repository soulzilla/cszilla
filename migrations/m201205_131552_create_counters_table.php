<?php

use app\components\core\Migration;

/**
* Class m201205_131552_create_counters_table
*/
class m201205_131552_create_counters_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('counters', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'views' => $this->integer()->notNull()->defaultValue(0),
            'likes' => $this->integer()->notNull()->defaultValue(0),
            'complaints' => $this->integer()->notNull()->defaultValue(0),
            'overviews' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->createIndex('index-entity-id-counters', 'counters', 'entity_id');
        $this->createIndex('index-entity-table-counters', 'counters', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('counters');
    }
}
