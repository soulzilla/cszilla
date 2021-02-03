<?php

use app\components\core\Migration;

/**
* Class m210203_205915_create_galleries_table
*/
class m210203_205915_create_galleries_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('attachments', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'source' => $this->string()->notNull()
        ]);

        $this->createIndex('index-entity-id-attachments', 'attachments', 'entity_id');
        $this->createIndex('index-entity-table-attachments', 'attachments', 'entity_table');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('attachments');
    }
}
