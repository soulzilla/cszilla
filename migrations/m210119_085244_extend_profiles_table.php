<?php

use app\components\core\Migration;

/**
* Class m210119_085244_extend_profiles_table
*/
class m210119_085244_extend_profiles_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('profiles', 'vk_url', $this->string()->unique());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('profiles', 'vk_url');
    }
}
