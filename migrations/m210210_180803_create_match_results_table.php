<?php

use app\components\core\Migration;

/**
* Class m210210_180803_create_match_results_table
*/
class m210210_180803_create_match_results_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('match_results', [
            'id' => $this->primaryKey(),
            'match_id' => $this->integer()->notNull(),
            'winner_team' => $this->integer()->notNull(),
            'state' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->ts('match_results');

        $this->createTable('prediction_counters', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'predictions' => $this->integer()->notNull()->defaultValue(0),
            'success_predictions' => $this->integer()->notNull()->defaultValue(0),
            'win_rate' => $this->string()->notNull()->defaultValue('0'),
            'update_ts' => $this->string()->notNull()
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210210_180803_create_match_results_table cannot be reverted.\n";

        return false;
    }
}
