<?php

use app\components\core\Migration;

/**
* Class m201221_133401_add_winners_count_to_contests
*/
class m201221_133401_add_winners_count_to_contests extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('contests', 'winners_count', $this->smallInteger()->notNull()->defaultValue(0));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('contests', 'winners_count');
    }
}
