<?php

use app\components\core\Migration;

/**
* Class m201128_111921_add_url_to_banners
*/
class m201128_111921_add_url_to_banners extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->addColumn('banners', 'url', $this->string());
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropColumn('banners', 'url');
    }
}
