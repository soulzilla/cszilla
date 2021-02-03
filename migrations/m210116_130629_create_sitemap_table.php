<?php

use app\components\core\Migration;

/**
* Class m210116_130629_create_sitemap_table
*/
class m210116_130629_create_sitemap_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('sitemap', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'last_mod' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'entity_table' => $this->string()->notNull()
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('sitemap');
    }
}
