<?php

use app\components\core\Migration;

/**
* Class m210129_193236_create_boxes_table
*/
class m210129_193236_create_boxes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->dropTable('boxes');

        $this->createTable('boxes', [
            'id' => $this->primaryKey(),
            'site_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(),
            'show_url' => $this->smallInteger()->notNull()->defaultValue(0),
            'cost' => $this->integer()->notNull()->defaultValue(0),
            'average_drop' => $this->string()
        ]);

        $this->createIndex('index-site-id-boxes', 'boxes', 'site_id');
        $this->ts('boxes');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('boxes');
    }
}
