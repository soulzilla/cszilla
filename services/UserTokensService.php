<?php

namespace app\services;

use app\components\core\Service;
use app\models\User;
use app\models\UserToken;
use app\enums\TokensEnum;
use Yii;
use yii\base\Exception;
use yii\db\Expression;

class UserTokensService extends Service
{
    public function getModel()
    {
        return new UserToken();
    }

    /**
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function generateAuthToken(User $user)
    {
        $token = $this->generateToken($user);
        $token->type = TokensEnum::AUTH_TOKEN_TYPE;

        return $token->save();
    }

    public function generateEmailValidationToken(User $user)
    {
        if ($user->email_confirmed) {
            return true;
        }

        $token = $this->generateToken($user);

        $token->type = TokensEnum::EMAIL_VALIDATION_TOKEN;

        return $token->save();
    }

    public function generatePasswordResetToken(User $user)
    {
        $token = $this->generateToken($user);

        $token->type = TokensEnum::RESET_PASSWORD_TOKEN;

        return $token->save();
    }

    private function generateToken(User $user)
    {
        $token = new UserToken();
        $token->user_id = $user->id;
        $token->token = Yii::$app->security->generateRandomString();
        $token->expire_ts = date('Y-m-d H:i:s', time()+30*24*60*60);
        $token->is_used = 0;

        return $token;
    }

    public function findToken(string $token)
    {
        return UserToken::find()
            ->where(['token' => $token])
            ->andWhere(['is_used' => 0])
            ->andWhere(['>', 'expire_ts', new Expression('NOW()')])
            ->with(['user'])
            ->one();
    }

    public function activate(UserToken $token)
    {
        $token->is_used = 1;

        return $token->save();
    }
}
