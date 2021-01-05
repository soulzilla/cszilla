<?php

use app\components\core\Migration;

/**
* Class m201112_190233_create_complaints_table
*/
class m201112_190233_create_complaints_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('complaints', [
            'id' => $this->primaryKey(),
            'entity_table' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'body' => $this->text()->notNull(),
            'admin_answer' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->ts('complaints');
        $this->isDeleted('complaints');

        $this->createTable('overviews', [
            'id' => $this->primaryKey(),
            'entity_table' => $this->string()->notNull(),
            'entity_id' => $this->integer()->notNull(),
            'body' => $this->text()->notNull()
        ]);

        $this->ts('overviews');
        $this->isDeleted('overviews');
        $this->isBlocked('overviews');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('complaints');
        $this->dropTable('overviews');
    }
}
