<?php

use app\components\core\Migration;

/**
* Class m210129_200418_create_game_modes_table
*/
class m210129_200418_create_game_modes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('boxes', 'order', $this->smallInteger());

        $this->createTable('game_modes', [
            'id' => $this->primaryKey(),
            'casino_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'order' => $this->smallInteger(),
            'description' => $this->text(),
        ]);
        $this->ts('game_modes');
        $this->createIndex('index-casino-id-game-modes', 'game_modes', 'casino_id');

        $this->createTable('bet_lines', [
            'id' => $this->primaryKey(),
            'bookmaker_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'order' => $this->smallInteger(),
        ]);
        $this->ts('bet_lines');
        $this->createIndex('index-bookmaker-id-bet-lines', 'bet_lines', 'bookmaker_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('game_modes');
        $this->dropTable('bet_lines');
    }
}
