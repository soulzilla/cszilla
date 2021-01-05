<?php

use app\components\core\Migration;

/**
* Class m201018_022737_create_profiles_table
*/
class m201018_022737_create_profiles_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('profiles', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'steam_trade_link' => $this->string()->unique(),
            'steam_url' => $this->string()->unique()
        ]);

        $this->createIndex('index-user-id-profiles', 'profiles', 'user_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('profiles');
    }
}
