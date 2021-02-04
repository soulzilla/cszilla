<?php

use app\components\core\Migration;

/**
* Class m201128_121151_add_announce_publications
*/
class m201128_121151_add_announce_publications extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('publications', 'announce', $this->text());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('publications', 'announce');
    }
}
