<?php

use app\components\core\Migration;

/**
* Class m210112_155811_extend_notifications_table
*/
class m210112_155811_extend_notifications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->ts('notifications');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('notifications', 'ts');
    }
}
