<?php

use app\components\core\Migration;

/**
* Class m210220_235007_extend_matches_table
*/
class m210220_235007_extend_matches_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        \app\models\GameMatch::deleteAll();
        $this->addColumn('game_matches', 'hltv_id', $this->bigInteger()->notNull());
        $this->addColumn('game_matches', 'hltv_url', $this->string()->notNull());
        $this->createIndex('index-game-matches-hltv-id', 'game_matches', 'hltv_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210220_235007_extend_matches_table cannot be reverted.\n";

        return false;
    }
}
