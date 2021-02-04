<?php

use app\components\core\Migration;

/**
* Class m210112_153351_extend_notifications_table
*/
class m210112_153351_extend_notifications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('notifications', 'source_id', $this->integer()->notNull());
        $this->addColumn('notifications', 'source_table', $this->string()->notNull());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('notifications', 'source_id');
        $this->dropColumn('notifications', 'source_table');
    }
}
