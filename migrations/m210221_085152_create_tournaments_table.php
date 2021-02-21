<?php

use app\components\core\Migration;

/**
* Class m210221_085152_create_tournaments_table
*/
class m210221_085152_create_tournaments_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('tournaments', [
            'id' => $this->primaryKey(),
            'format' => $this->integer()->notNull(),
            'regulations' => $this->text()->notNull(),
            'twitch_stream' => $this->string()->notNull(),
            'show_stream' => $this->smallInteger()->notNull()->defaultValue(0),
            'competitors_limit' => $this->smallInteger()->notNull(),
            'prize_pool' => $this->text()->notNull(),
            'serial_number' => $this->integer()->notNull(),
            'date_start' => $this->timestamp()->notNull(),
        ]);
        $this->ts('tournaments');
        $this->isPublished('tournaments');
        $this->createIndex('index-format-tournaments', 'tournaments', 'format');

        $this->createTable('custom_teams', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'invite_code' => $this->string(10)->notNull(),
        ]);

        $this->ts('custom_teams');
        $this->createIndex('index-user-id-user-teams', 'custom_teams', 'user_id');
        $this->createIndex('index-invite-code-user-teams', 'custom_teams', 'invite_code');

        $this->createTable('players', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull()
        ]);
        $this->createIndex('index-user-id-players', 'players', 'user_id');
        $this->createIndex('index-team-id-players', 'players', 'team_id');

        $this->addColumn('profiles', 'faceit_url', $this->string()->unique());

        $this->createTable('tournament_teams', [
            'id' => $this->primaryKey(),
            'tournament_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('index-tournament-id-teams', 'tournament_teams', 'tournament_id');
        $this->createIndex('index-team-id-teams', 'tournament_teams', 'team_id');

        $this->createTable('tournament_matches', [
            'id' => $this->primaryKey(),
            'tournament_id' => $this->integer()->notNull(),
            'first_team' => $this->integer()->notNull(),
            'second_team' => $this->integer()->notNull(),
            'stage' => $this->integer()->notNull(),
            'score_first' => $this->integer(),
            'score_second' => $this->integer(),
        ]);
        $this->createIndex('index-tournament-id-matches', 'tournament_matches', 'tournament_id');
        $this->createIndex('index-first-id-teams', 'tournament_teams', 'first_team');
        $this->createIndex('index-second-id-teams', 'tournament_teams', 'second_team');

    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210221_085152_create_tournaments_table cannot be reverted.\n";

        return false;
    }
}
