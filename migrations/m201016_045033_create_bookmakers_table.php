<?php

use app\components\core\Migration;

/**
* Class m201016_045033_create_bookmakers_table
*/
class m201016_045033_create_bookmakers_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('bookmakers', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_canonical' => $this->string()->notNull()->unique(),
            'logo' => $this->text(),
            'description' => $this->text()->notNull(),
            'pros' => $this->text(),
            'cons' => $this->text(),
            'order' => $this->integer()->unique(),
            'currencies' => $this->text(),
            'payment_methods' => $this->text(),
            'website' => $this->string()->notNull(),
            'android_app' => $this->string(),
            'ios_app' => $this->string(),
            'has_live_mode' => $this->smallInteger()->notNull()->defaultValue(0),
            'margin' => $this->string(),
            'has_license' => $this->smallInteger()->notNull()->defaultValue(0),
            'cupis' => $this->smallInteger()->notNull()->defaultValue(0),
            'recommended' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->createIndex('index-name-canonical-bookmakers', 'bookmakers', 'name_canonical');

        $this->ts('bookmakers');
        $this->isPublished('bookmakers');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('bookmakers');
    }
}
