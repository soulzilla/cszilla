<?php

namespace app\services;

use app\components\core\Service;
use app\models\User;
use app\models\OnlineUser;

class OnlineUsersService extends Service
{
    public function generateStatus(User $user)
    {
        $status = new OnlineUser();
        $status->user_id = $user->id;
        $status->last_seen = date('Y-m-d H:i:s');

        return $status->save();
    }

    public function getModel()
    {
        return new OnlineUser();
    }
}
