<?php

use app\components\core\Migration;

/**
* Class m210207_203349_extend_static_blocks_table
*/
class m210207_203349_extend_static_blocks_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropColumn('static_blocks', 'is_deleted');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210207_203349_extend_static_blocks_table cannot be reverted.\n";

        return false;
    }
}
