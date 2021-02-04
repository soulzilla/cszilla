<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_modes".
 *
 * @property int $id
 * @property int $casino_id
 * @property string $name
 * @property int|null $order
 * @property string|null $description
 * @property string|null $ts
 */
class GameMode extends \app\components\core\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_modes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['casino_id', 'name'], 'required'],
            [['casino_id', 'order'], 'default', 'value' => null],
            [['casino_id', 'order'], 'integer'],
            [['description'], 'string'],
            [['ts'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'casino_id' => 'Рулетка',
            'name' => 'Название',
            'order' => 'Порядок',
            'description' => 'Описание',
        ];
    }

    public function getCasino()
    {
        return $this->hasOne(Casino::class, ['id' => 'casino_id']);
    }
}
