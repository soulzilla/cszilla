<?php

use app\components\core\Migration;

/**
* Class m201221_132519_add_order_to_prizes
*/
class m201221_132519_add_order_to_prizes extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('prizes', 'order', $this->smallInteger()->notNull()->defaultValue(0));
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('prizes', 'order');
    }
}
