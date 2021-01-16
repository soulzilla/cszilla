<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * Class Sitemap
 * @package app\models
 *
 * @property int $id
 * @property string url
 * @property string $last_mod
 * @property string $entity_table
 * @property int $entity_id
 */
class Sitemap extends ActiveRecord
{
    public static function tableName()
    {
        return 'sitemap';
    }

    public function rules()
    {
        return [
            [['url', 'last_mod', 'entity_id', 'entity_table'], 'required'],
            [['url', 'last_mod', 'entity_table'], 'string'],
            [['entity_id'], 'integer']
        ];
    }
}
