<?php

use app\components\core\Migration;

/**
* Class m210111_092513_create_observers_table
*/
class m210111_092513_create_observers_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('observers', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull()
        ]);

        $this->createIndex('index-user-observers', 'observers', 'user_id');
        $this->createIndex('index-entity-observers', 'observers', 'entity_id');
        $this->createIndex('index-entity-table-observers', 'observers', 'entity_table');

        $this->createTable('observers_counters', [
            'id' => $this->primaryKey(),
            'count' => $this->integer()->notNull()->defaultValue(0),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull()
        ]);

        $this->createIndex('index-entity-observers-counters', 'observers_counters', 'entity_id');
        $this->createIndex('index-entity-table-observers-counters', 'observers_counters', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('observers');
        $this->dropTable('observers_counters');
    }
}
