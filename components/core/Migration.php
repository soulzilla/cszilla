<?php

namespace app\components\core;

use yii\db\Expression;

class Migration extends \yii\db\Migration
{
    public function soundEx($tableName, $attribute)
    {
        $soundexAttribute = $attribute . '_soundex';
        $index = 'index-' . $tableName . '-' . $attribute . '-soundex';
        $this->addColumn($tableName, $soundexAttribute, $this->text());
        return $this->createIndex($index, $tableName, $soundexAttribute);
    }

    public function phoneme($tableName, $attribute)
    {
        $phonemeAttribute = $attribute . '_phoneme';
        $index = 'index-' . $tableName . '-' . $attribute . '-phoneme';
        $this->addColumn($tableName, $phonemeAttribute, $this->text());
        return $this->createIndex($index, $tableName, $phonemeAttribute);
    }

    public function trigram($tableName, $attribute)
    {
        $trigramAttribute = $attribute . '_trigram';
        $index = 'index-' . $tableName . '-' . $attribute . '-trigram';
        $this->addColumn($tableName, $trigramAttribute, $this->text());
        return $this->createIndex($index, $tableName, $trigramAttribute);
    }

    public function ts($tableName)
    {
        return $this->addColumn($tableName, 'ts', $this->timestamp()->defaultValue(new Expression('NOW()')));
    }

    public function isDeleted($tableName)
    {
        $this->addColumn($tableName, 'is_deleted', $this->smallInteger()->notNull()->defaultValue(0));
        $index = 'index-' . $tableName . '-deleted';
        return $this->createIndex($index, $tableName, 'is_deleted');
    }

    public function isPublished($tableName)
    {
        $this->addColumn($tableName, 'is_published', $this->smallInteger()->notNull()->defaultValue(0));
        $index = 'index-' . $tableName . '-published';
        return $this->createIndex($index, $tableName, 'is_published');
    }

    public function isBlocked($tableName)
    {
        $this->addColumn($tableName, 'is_blocked', $this->smallInteger()->notNull()->defaultValue(0));
        $index = 'index-' . $tableName . '-blocked';
        return $this->createIndex($index, $tableName, 'is_blocked');
    }

    public function hash($tableName)
    {
        $this->addColumn($tableName, 'hash', $this->string()->notNull());
        $index = 'index-' . $tableName . '-hash';
        return $this->createIndex($index, $tableName, 'hash');
    }

    public function createTable($table, $columns, $options = null)
    {
        if (!isset($columns['id'])) {
            $columns['id'] = $this->primaryKey();
        }

        if (!($schema = $this->getDb()->getTableSchema($table))) {
            parent::createTable($table, $columns, $options);
        }
    }

    public function dropTable($table)
    {
        if ($schema = $this->getDb()->getTableSchema($table)) {
            parent::dropTable($table);
        }
    }

    public function addColumn($table, $column, $type)
    {
        $schema = $this->getDb()->getTableSchema($table);
        if (!$schema->getColumn($column)) {
            parent::addColumn($table, $column, $type);
        }
    }

    public function dropColumn($table, $column)
    {
        $schema = $this->getDb()->getTableSchema($table);
        if ($schema->getColumn($column)) {
            parent::dropColumn($table, $column);
        }
    }
}