<?php

use app\components\core\Migration;
use yii\db\Expression;

/**
* Class m200823_204737_create_users_table
*/
class m200823_204737_create_users_table extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull()->unique(),
            'password_hash' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'roles' => $this->text()->notNull(),
            'email_confirmed' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);

        $this->ts('users');
        $this->isDeleted('users');
        $this->isBlocked('users');
        $this->hash('users');

        $this->createIndex('index-users-name', 'users', 'name');
        $this->createIndex('index-email-name', 'users', 'email');

        $this->createTable('user_tokens', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'token' => $this->string()->notNull(),
            'expire_ts' => $this->timestamp()->notNull(),
            'is_used' => $this->smallInteger()->notNull()->defaultValue(0)
        ]);
        $this->ts('user_tokens');

        $this->createIndex('index-user-tokens-user', 'user_tokens', 'user_id');
        $this->createIndex('index-user-tokens-used', 'user_tokens', 'is_used');
        $this->createIndex('index-user-tokens-type', 'user_tokens', 'type');
        $this->createIndex('index-user-tokens-token', 'user_tokens', 'token');
        $this->createIndex('index-user-tokens-expire-ts', 'user_tokens', 'expire_ts');

        $this->createTable('online_users', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'last_seen' => $this->timestamp()->notNull()->defaultValue(new Expression('NOW()')),
        ]);

        $this->createIndex('index-online-users-user', 'online_users', 'user_id');
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('user_tokens');
        $this->dropTable('online_users');
    }
}
