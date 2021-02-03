<?php

use app\components\core\Migration;
use yii\db\Expression;

/**
* Class m201105_112637_create_giveaways_table
*/
class m201105_112637_create_giveaways_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('contests', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'date_start' => $this->timestamp()->notNull()->defaultValue(new Expression('NOW()')),
            'date_end' => $this->timestamp()->notNull(),
            'partner_id' => $this->integer(),
            'partner_type' => $this->string()
        ]);

        $this->isPublished('contests');
        $this->ts('contests');

        $this->createTable('prizes', [
            'id' => $this->primaryKey(),
            'contest_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'sent' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->createIndex('index-contest-id-prizes', 'prizes', 'contest_id');

        $this->createTable('contest_participants', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'contest_id' => $this->integer()->notNull(),
            'is_winner' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->createIndex('index-contest-id-contest-participants', 'contest_participants', 'contest_id');
        $this->createIndex('index-user-id-contest-participants', 'contest_participants', 'user_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('contests');
        $this->dropTable('prizes');
        $this->dropTable('contest_participants');
    }
}
