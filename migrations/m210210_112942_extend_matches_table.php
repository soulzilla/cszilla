<?php

use app\components\core\Migration;

/**
* Class m210210_112942_extend_matches_table
*/
class m210210_112942_extend_matches_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('game_matches', 'is_finished', $this->smallInteger()->notNull()->defaultValue(0));
        $this->addColumn('game_matches', 'final_score', $this->string());
        $this->ts('game_matches');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210210_112942_extend_matches_table cannot be reverted.\n";

        return false;
    }
}
