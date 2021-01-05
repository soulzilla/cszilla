<?php

use app\components\core\Migration;

/**
* Class m201104_165501_create_promocodes_table
*/
class m201104_165501_create_promocodes_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('promo_codes', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->smallInteger()->notNull(),
            'entity_table' => $this->string()->notNull(),
            'description' => $this->text(),
            'amount' => $this->string(),
            'url' => $this->string(),
            'code' => $this->string()->notNull(),
            'activations' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->ts('promo_codes');
        $this->isPublished('promo_codes');
        $this->createIndex('index-entity-id-promo_codes', 'promo_codes', 'entity_id');
        $this->createIndex('index-entity-table-promo_codes', 'promo_codes', 'entity_table');

        $this->createTable('promo_codes_statuses', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'code_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('index-promo-codes-statuses-user-id', 'promo_codes_statuses', 'user_id');
        $this->createIndex('index-promo-codes-statuses-code-id', 'promo_codes_statuses', 'code_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('promo_codes');
        $this->dropTable('promo_codes_statuses');
    }
}
