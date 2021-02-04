<?php

use app\components\core\Migration;

/**
* Class m201112_181151_create_videos_table
*/
class m201112_181151_create_videos_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('videos', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'url' => $this->string()->notNull(),
            'source' => $this->smallInteger()->notNull()
        ]);

        $this->isPublished('videos');
        $this->ts('videos');

        $this->createTable('streams', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'url' => $this->string()->notNull(),
            'source' => $this->smallInteger()->notNull(),
            'is_finished' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->ts('streams');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('videos');
        $this->dropTable('streams');
    }
}
