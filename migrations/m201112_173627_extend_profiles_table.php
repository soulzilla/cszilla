<?php

use app\components\core\Migration;

/**
* Class m201112_173627_extend_profiles_table
*/
class m201112_173627_extend_profiles_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('profiles', 'about', $this->text());
        $this->addColumn('profiles', 'interesting_bookmakers', $this->text());
        $this->addColumn('profiles', 'interesting_casinos', $this->text());
        $this->addColumn('profiles', 'interesting_loot_boxes', $this->text());

        $this->addColumn('prizes', 'order', $this->smallInteger()->notNull()->defaultValue(1));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('profiles', 'about');
        $this->dropColumn('profiles', 'interesting_bookmakers');
        $this->dropColumn('profiles', 'interesting_casinos');
        $this->dropColumn('profiles', 'interesting_loot_boxes');

        $this->dropColumn('prizes', 'order');
    }
}
