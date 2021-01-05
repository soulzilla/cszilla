<?php

use app\components\core\Migration;

/**
* Class m201205_210304_create_comments_table
*/
class m201205_210304_create_comments_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('overviews', 'user_id', $this->integer()->notNull());
        $this->addColumn('complaints', 'user_id', $this->integer()->notNull());
        $this->addColumn('comments', 'parent_id', $this->integer());

        $this->createIndex('index-overviews-user-id', 'overviews', 'user_id');
        $this->createIndex('index-complaints-user-id', 'complaints', 'user_id');
        $this->createIndex('index-comments-parent-id', 'comments', 'parent_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('overviews', 'user_id');
        $this->dropColumn('complaints', 'user_id');
        $this->dropColumn('comments', 'parent_id');
    }
}
