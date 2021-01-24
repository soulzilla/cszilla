<?php

use app\components\core\Migration;

/**
* Class m210124_141423_extend_banners_table
*/
class m210124_141423_extend_banners_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropColumn('publications', 'announce');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->addColumn('publications', 'announce', $this->text());
    }
}
