<?php

use app\components\core\Migration;

/**
* Class m201104_164605_create_bonuses_table
*/
class m201104_164605_create_bonuses_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('bonuses', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'amount' => $this->integer()->notNull(),
            'currency' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'rules' => $this->text()->notNull(),
            'url' => $this->string(),
            'pinned' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->ts('bonuses');
        $this->isPublished('bonuses');
        $this->createIndex('index-entity-id-bonuses', 'bonuses', 'entity_id');
        $this->createIndex('index-entity-table-bonuses', 'bonuses', 'entity_table');
        $this->createIndex('index-pinned-bonuses', 'bonuses', 'pinned');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('bonuses');
    }
}
