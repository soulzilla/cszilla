<?php

use app\components\core\Migration;

/**
* Class m210111_085047_extend_profiles_table
*/
class m210111_085047_extend_profiles_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('profiles', 'interesting_categories', $this->text());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('profiles', 'interesting_categories');
    }
}
