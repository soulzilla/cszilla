<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $steam_trade_link
 * @property string|null $steam_url
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
            [['about'], 'string'],
            [['about'], 'filter', 'filter' => function ($value) {
                return Html::encode($value);
            }],
            [['steam_url', 'steam_trade_link'], 'filter', 'filter' => function ($value) {
                if ($value === '') {
                    return null;
                }
                return $value;
            }]
        ];
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
            'about' => 'Обо мне',
        ];
    }

    public function attributeHints()
    {
        return [
            'name' => 'Не используется для авторизации, а для вывода никнейма на сайте'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function updateParam($type, $id, $state)
    {
        $observer = Observer::find()->where([
            'user_id' => Yii::$app->user->id,
            'entity_id' => $id,
            'entity_table' => $type
        ])->one();

        if ($observer && $state == 'false') {
            $observer->delete();
        }

        if (!$observer && $state == 'true') {
            $observer = new Observer();
            $observer->user_id = Yii::$app->user->id;
            $observer->entity_id = $id;
            $observer->entity_table = $type;
            $observer->save();
        }
    }
}
