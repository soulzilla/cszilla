<?php

use app\components\core\Migration;

/**
* Class m210112_154747_extend_observers_table
*/
class m210112_154747_extend_observers_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->ts('observers');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('observers', 'ts');
    }
}
