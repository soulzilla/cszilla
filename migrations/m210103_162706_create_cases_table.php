<?php

use app\components\core\Migration;

/**
* Class m210103_162706_create_cases_table
*/
class m210103_162706_create_cases_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('boxes', [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer()->notNull(),
            'military_cost' => $this->string(),
            'military_average' => $this->string(),
            'restricted_cost' => $this->string(),
            'restricted_average' => $this->string(),
            'classified_cost' => $this->string(),
            'classified_average' => $this->string(),
            'covert_cost' => $this->string(),
            'covert_average' => $this->string(),
            'knife_cost' => $this->string(),
            'knife_average' => $this->string(),
            'gloves_cost' => $this->string(),
            'gloves_average' => $this->string(),
            'ak_cost' => $this->string(),
            'ak_average' => $this->string(),
            'awp_cost' => $this->string(),
            'awp_average' => $this->string(),
            'deagle_cost' => $this->string(),
            'deagle_average' => $this->string(),
            'glock_cost' => $this->string(),
            'glock_average' => $this->string(),
            'm4a1_cost' => $this->string(),
            'm4a1_average' => $this->string(),
            'usp_cost' => $this->string(),
            'usp_average' => $this->string(),
            'm4a4_cost' => $this->string(),
            'm4a4_average' => $this->string(),
            'top_cost' => $this->string(),
            'top_average' => $this->string(),
        ]);

        $this->createIndex('index-site-id-boxes', 'boxes', 'site_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('boxes');
    }
}
