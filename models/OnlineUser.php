<?php

namespace app\models;

use app\components\core\ActiveRecord;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "online_users".
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_seen
 */
class OnlineUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'online_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer']
        ];
    }

    /**
     * @return bool|false|int
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function renew()
    {
        $this->last_seen = date('Y-m-d H:i:s');
        return $this->update();
    }
}
