<?php

use app\components\core\Migration;

/**
* Class m210112_170236_extend_profiles_table
*/
class m210112_170236_extend_profiles_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropColumn('profiles', 'interesting_bookmakers');
        $this->dropColumn('profiles', 'interesting_casinos');
        $this->dropColumn('profiles', 'interesting_loot_boxes');
        $this->dropColumn('profiles', 'interesting_categories');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210112_170236_extend_profiles_table cannot be reverted.\n";

        return false;
    }
}
