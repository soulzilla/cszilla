<?php

use app\components\core\Migration;

/**
* Class m210225_132349_extend_custom_teams_table
*/
class m210225_132349_extend_custom_teams_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('custom_teams', 'format', $this->smallInteger()->notNull());
        $this->createIndex('index-format-custom-teams', 'custom_teams','format');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('custom_teams', 'format');
    }
}
