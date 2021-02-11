<?php

use app\components\core\Migration;

/**
* Class m210211_001331_create_questions_table
*/
class m210211_001331_create_questions_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('faq', [
            'id' => $this->primaryKey(),
            'category' => $this->smallInteger()->notNull(),
            'order' => $this->smallInteger()->notNull(),
            'question' => $this->string()->notNull(),
            'answer' => $this->text()
        ]);

        $this->ts('faq');

        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'title_canonical' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'order' => $this->smallInteger()->notNull(),
        ]);

        $this->ts('pages');
        $this->isPublished('pages');

        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'email' => $this->string(),
            'additional_info' => $this->string(),
            'content' => $this->text()->notNull(),
        ]);

        $this->ts('messages');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('faq');
        $this->dropTable('pages');
        $this->dropTable('messages');
    }
}
