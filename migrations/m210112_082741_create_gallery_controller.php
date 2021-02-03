<?php

use app\components\core\Migration;

/**
* Class m210112_082741_create_gallery_controller
*/
class m210112_082741_create_gallery_controller extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull()
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('gallery');
    }
}
