<?php

use app\components\core\Migration;
use app\models\Category;
use app\models\CategoryPublications;
use app\models\Publication;

/**
* Class m201128_105423_create_category_publications_count_table
*/
class m201128_105423_create_category_publications_count_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('category_publications', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'count' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->createIndex('index-category-id-category-publications', 'category_publications', 'category_id');

        $categories = Category::find()->all();

        if ($categories) {
            foreach ($categories as $category) {
                $counter = new CategoryPublications();
                $counter->category_id = $category->id;
                $counter->count = Publication::find()->where(['category_id' => $category->id])->count();
                $counter->save();
            }
        }
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('category_publications');
    }
}
