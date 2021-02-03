<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * Class Attachment
 * @package app\models
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property int $type
 * @property string $source
 */
class Attachment extends ActiveRecord
{
    public static function tableName()
    {
        return 'attachments';
    }

    public function rules()
    {
        return [
            [['entity_id', 'entity_table', 'type', 'source'], 'required'],
            [['source'], 'string']
        ];
    }
}
