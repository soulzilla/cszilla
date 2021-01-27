<?php

use app\components\core\Migration;

/**
* Class m210127_152604_drop_notifications_table
*/
class m210127_152604_drop_notifications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropTable('notifications');
        $this->dropTable('notification_statuses');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210127_152604_drop_notifications_table cannot be reverted.\n";

        return false;
    }
}
