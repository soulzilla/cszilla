<?php

use app\components\core\Migration;

/**
* Class m210209_212606_create_teams_table
*/
class m210209_212606_create_teams_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('teams', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'logo' => $this->string()->notNull()
        ]);

        $this->createTable('game_matches', [
            'id' => $this->primaryKey(),
            'first_team' => $this->integer()->notNull(),
            'second_team' => $this->integer()->notNull(),
            'winner_team' => $this->integer(),
            'start_ts' => $this->timestamp()->notNull()
        ]);

        $this->createIndex('index-first-team-matches', 'game_matches', 'first_team');
        $this->createIndex('index-second-team-matches', 'game_matches', 'second_team');

        $this->createTable('predictions', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'match_id' => $this->integer()->notNull(),
            'selected_team' => $this->integer()->notNull(),
            'is_winner' => $this->smallInteger()->notNull()
        ]);

        $this->createIndex('index-user-predictions', 'predictions', 'user_id');
        $this->createIndex('index-match-predictions', 'predictions', 'match_id');
        $this->createIndex('index-winner-predictions', 'predictions', 'is_winner');

        $this->createTable('wallets', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'coins' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-user-wallets', 'wallets', 'user_id');

        $this->createTable('wallet_tasks', [
            'id' => $this->primaryKey(),
            'content' => $this->string()->notNull(),
            'url' => $this->string()->notNull(),
            'cost' => $this->integer()->notNull(),
        ]);

        $this->createTable('task_statuses', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-task-task-statuses', 'task_statuses', 'task_id');
        $this->createIndex('index-user-task-statuses', 'task_statuses', 'user_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210209_212606_create_teams_table cannot be reverted.\n";

        return false;
    }
}
