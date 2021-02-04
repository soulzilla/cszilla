<?php

use app\components\core\Migration;

/**
* Class m201128_104942_add_order_categories_table
*/
class m201128_104942_add_order_categories_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('categories', 'order', $this->smallInteger()->notNull()->defaultValue(1));
        $this->addColumn('categories', 'color', $this->string());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('categories', 'order');
        $this->dropColumn('categories', 'color');
    }
}
