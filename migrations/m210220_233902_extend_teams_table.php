<?php

use app\components\core\Migration;

/**
* Class m210220_233902_extend_teams_table
*/
class m210220_233902_extend_teams_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        \app\models\Team::deleteAll();
        $this->addColumn('teams', 'hltv_id', $this->integer()->notNull());
        $this->addColumn('teams', 'hltv_profile', $this->string());
        $this->createIndex('index-hltv-id-teams', 'teams', 'hltv_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropIndex('index-hltv-id-teams', 'teams');
        $this->dropColumn('teams', 'hltv_id');
    }
}
