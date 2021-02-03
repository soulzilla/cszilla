<?php

namespace app\services;

use app\components\core\Service;
use app\models\Profile;
use app\models\User;

class ProfilesService extends Service
{
    public function getModel()
    {
        return new Profile();
    }

    public function createProfile(User $user)
    {
        $profile = $this->getModel();
        $profile->name = $user->name;
        $profile->user_id = $user->id;

        return $profile->save();
    }
}
