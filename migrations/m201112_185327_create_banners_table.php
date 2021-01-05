<?php

use app\components\core\Migration;
use yii\db\Expression;

/**
* Class m201112_185327_create_banners_table
*/
class m201112_185327_create_banners_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('banners', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'background_image' => $this->text(),
            'order' => $this->smallInteger()->notNull()->defaultValue(1),
        ]);

        $this->isPublished('banners');
        $this->ts('banners');

        $this->createTable('tickers', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'date_start' => $this->timestamp()->notNull()->defaultValue(new Expression('NOW()')),
            'date_end' => $this->timestamp()->notNull()
        ]);

        $this->ts('tickers');

        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'order' => $this->smallInteger()->notNull()->defaultValue(10)
        ]);

        $this->ts('reviews');
        $this->isPublished('reviews');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('banners');
        $this->dropTable('tickers');
        $this->dropTable('reviews');
    }
}
