<?php

namespace app\models;

use app\components\core\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $steam_trade_link
 * @property string|null $steam_url
 * @property string|null $interesting_bookmakers
 * @property string|null $interesting_casinos
 * @property string|null $interesting_loot_boxes
 * @property string|null $interesting_categories
 *
 * @property User $user
 */
class Profile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'steam_trade_link', 'steam_url'], 'string', 'max' => 255],
            [['steam_trade_link', 'steam_url'], 'unique'],
            [['interesting_bookmakers', 'interesting_casinos', 'interesting_loot_boxes'], 'safe'],
            [['about'], 'string'],
            [['about'], 'filter', 'filter' => function ($value) {
                return Html::encode($value);
            }]
        ];
    }

    public function jsonAttributes()
    {
        return ['interesting_bookmakers', 'interesting_casinos', 'interesting_loot_boxes', 'interesting_categories'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'name' => 'Никнейм',
            'steam_trade_link' => 'Ссылка на обмен в стиме',
            'steam_url' => 'Ссылка на профиль стим',
            'interesting_bookmakers' => 'Интересные букмекеры',
            'interesting_casinos' => 'Интересные казино',
            'interesting_loot_boxes' => 'Интересные сайты с лутбоксами',
            'about' => 'Обо мне',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function updateParam($type, $id, $state)
    {
        switch ($type) {
            case 'bookmakers':
                $map = $this->interesting_bookmakers ?? [];
                $map[$id] = $state;
                $this->interesting_bookmakers = $map;
                $this->save();
                break;
            case 'loot-boxes':
                $map = $this->interesting_loot_boxes ?? [];
                $map[$id] = $state;
                $this->interesting_loot_boxes = $map;
                $this->save();
                break;
            case 'casinos':
                $map = $this->interesting_casinos ?? [];
                $map[$id] = $state;
                $this->interesting_casinos = $map;
                $this->save();
                break;
            case 'categories':
                $map = $this->interesting_categories ?? [];
                $map[$id] = $state;
                $this->interesting_categories = $map;
                $this->save();
                break;
        }
    }
}
