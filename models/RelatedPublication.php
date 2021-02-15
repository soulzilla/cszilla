<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "related_publications".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property int $publication_id
 *
 * @property Publication $publication
 */
class RelatedPublication extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'related_publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_table', 'publication_id'], 'required'],
            [['entity_id', 'publication_id'], 'default', 'value' => null],
            [['entity_id', 'publication_id'], 'integer'],
            [['entity_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'entity_table' => 'Entity Table',
            'publication_id' => 'Publication ID',
        ];
    }

    public function getPublication()
    {
        return $this->hasOne(Publication::class, ['id' => 'publication_id']);
    }
}
