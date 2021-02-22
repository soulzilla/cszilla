<?php

use app\components\core\Migration;

/**
* Class m210222_001459_extend_tournaments_table
*/
class m210222_001459_extend_tournaments_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('tournaments', 'is_finished', $this->smallInteger()->notNull()->defaultValue(0));
        $this->addColumn('tournaments', 'winner', $this->integer());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210222_001459_extend_tournaments_table cannot be reverted.\n";

        return false;
    }
}
