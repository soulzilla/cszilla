<?php

use app\components\core\Migration;

/**
* Class m210121_144021_clear_notifications_table
*/
class m210121_144021_clear_notifications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        \app\models\Notification::deleteAll();
        \app\models\NotificationStatus::deleteAll();

        $this->addColumn('notifications', 'source_key', $this->string());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('notifications', 'source_key');
    }
}
