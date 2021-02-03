<?php

use app\components\core\Migration;

/**
* Class m201016_031626_create_categories_table
*/
class m201016_031626_create_categories_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'name_canonical' => $this->string()->notNull()->unique()
        ]);

        $this->isPublished('categories');
        $this->ts('categories');
        $this->createIndex('index-name-canonical-categories', 'categories', 'name_canonical');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
