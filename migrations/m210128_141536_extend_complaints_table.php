<?php

use app\components\core\Migration;

/**
* Class m210128_141536_extend_complaints_table
*/
class m210128_141536_extend_complaints_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->isBlocked('complaints');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('complaints', 'is_blocked');
    }
}
