<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bet_lines".
 *
 * @property int $id
 * @property int $bookmaker_id
 * @property string $name
 * @property int|null $order
 * @property string|null $ts
 */
class BetLine extends \app\components\core\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bet_lines';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bookmaker_id', 'name'], 'required'],
            [['bookmaker_id', 'order'], 'default', 'value' => null],
            [['bookmaker_id', 'order'], 'integer'],
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
            'bookmaker_id' => 'Букмекер',
            'name' => 'Название',
            'order' => 'Порядок',
            'ts' => 'Время создания',
        ];
    }

    public function getBookmaker()
    {
        return $this->hasOne(Bookmaker::class, ['id' => 'bookmaker_id']);
    }
}
