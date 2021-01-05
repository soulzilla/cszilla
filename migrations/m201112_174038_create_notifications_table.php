<?php

use app\components\core\Migration;

/**
* Class m201112_174038_create_notifications_table
*/
class m201112_174038_create_notifications_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('notifications', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'target_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-target-id-notifications', 'notifications', 'target_id');

        $this->createTable('notification_statuses', [
            'id' => $this->primaryKey(),
            'notification_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-user-id-notification-statuses', 'notification_statuses', 'user_id');
        $this->createIndex('index-notification-id-notification-statuses', 'notification_statuses', 'notification_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('notification_statuses');
        $this->dropTable('notifications');
    }
}
