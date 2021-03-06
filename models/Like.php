<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;
use yii\console\Application;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $entity_table
 * @property int $entity_id
 * @property int $is_deleted
 * @property string|null $ts
 */
class Like extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_table', 'entity_id'], 'required'],
            [['user_id', 'entity_id', 'is_deleted'], 'integer'],
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
            'user_id' => 'Пользователь',
            'entity_table' => 'Вид сущности',
            'entity_id' => 'Сущность',
            'is_deleted' => 'Удалён',
            'ts' => 'Время создания',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateEntityCounter();
        if ($insert) {
            $this->addCoins();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->updateEntityCounter();
    }

    public function restore()
    {
        $this->updateAll([
            'is_deleted' => 0
        ], [
            'id' => $this->id
        ]);
        $this->updateEntityCounter();
    }

    private function updateEntityCounter()
    {
        $counter = Counter::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->one();

        if (!$counter) {
            $counter = new Counter();
            $counter->entity_id = $this->entity_id;
            $counter->entity_table = $this->entity_table;
        }

        $count = Like::find()
            ->where([
                'entity_id' => $this->entity_id,
                'entity_table' => $this->entity_table,
                'is_deleted' => 0
            ])->count();

        $counter->likes = $count;
        $counter->save();
    }

    private function addCoins()
    {
        if (Yii::$app instanceof Application) {
            return;
        }
        $wallet = Yii::$app->user->identity->wallet;
        if (!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = Yii::$app->user->id;
            $wallet->coins = 10;
        }
        $currentCoins = $wallet->coins;
        $currentCoins += 1;
        $wallet->coins = $currentCoins;
        $wallet->save();
    }
}
