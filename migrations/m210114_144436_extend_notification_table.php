<?php

use app\components\core\Migration;

/**
* Class m210114_144436_extend_notification_table
*/
class m210114_144436_extend_notification_table extends Migration
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
