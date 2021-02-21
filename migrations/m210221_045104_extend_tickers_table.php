<?php

use app\components\core\Migration;

/**
* Class m210221_045104_extend_tickers_table
*/
class m210221_045104_extend_tickers_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('tickers', 'url', $this->string());
        $this->addColumn('tickers', 'target', $this->smallInteger()->notNull()->defaultValue(0));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('tickers', 'url');
        $this->dropColumn('tickers', 'target');
    }
}
