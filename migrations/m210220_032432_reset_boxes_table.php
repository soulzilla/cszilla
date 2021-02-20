<?php

use app\components\core\Migration;

/**
* Class m210220_032432_reset_boxes_table
*/
class m210220_032432_reset_boxes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        \app\models\Box::deleteAll();
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210220_032432_reset_boxes_table cannot be reverted.\n";

        return false;
    }
}
