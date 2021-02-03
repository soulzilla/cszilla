<?php

use app\components\core\Migration;

/**
* Class m210119_113508_extend_counters_table
*/
class m210119_113508_extend_counters_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('counters', 'ratings', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('counters', 'average_rating', $this->integer()->notNull()->defaultValue(0));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210119_113508_extend_counters_table cannot be reverted.\n";

        return false;
    }
}
