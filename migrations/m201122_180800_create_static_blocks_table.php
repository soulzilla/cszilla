<?php

use app\components\core\Migration;

/**
* Class m201122_180800_create_static_blocks_table
*/
class m201122_180800_create_static_blocks_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('static_blocks', [
            'id' => $this->primaryKey(),
            'type' => $this->smallInteger()->notNull(),
            'entity_id' => $this->integer(),
            'entity_table' => $this->string(),
            'content' => $this->text()
        ]);

        $this->isDeleted('static_blocks');
        $this->ts('static_blocks');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('static_blocks');
    }
}
