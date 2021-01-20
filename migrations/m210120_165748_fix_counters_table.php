<?php

use app\components\core\Migration;

/**
* Class m210120_165748_fix_counters_table
*/
class m210120_165748_fix_counters_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropColumn('counters', 'average_rating');
        $this->addColumn('counters', 'average_rating', $this->string()->notNull()->defaultValue(0));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210120_165748_fix_counters_table cannot be reverted.\n";

        return false;
    }
}
