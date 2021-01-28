<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\forms\PasswordChangeForm;
use app\traits\SoftDeleteTrait;
use app\filters\UsersFilter;
use app\models\User;
use app\forms\AuthForm;
use app\forms\RegistrationForm;
use Yii;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

class UsersService extends Service
{
    use SoftDeleteTrait;

    /**
     * @var yii\web\User
     */
    protected $webUser;

    /**
     * @var array
     */
    protected $roles;

    /**
     * @var OnlineUsersService
     */
    protected $onlineUsersService;

    /**
     * @var UserTokensService
     */
    protected $userTokensService;

    /**
     * @var ProfilesService
     */
    protected $profilesService;

    public function __construct(
        OnlineUsersService $onlineUsersService,
        UserTokensService $userTokensService,
        ProfilesService $profilesService,
        $config = []
    )
    {
        parent::__construct($config);
        $this->webUser = Yii::$app->user ?? null;
        $this->onlineUsersService = $onlineUsersService;
        $this->userTokensService = $userTokensService;
        $this->profilesService = $profilesService;
    }

    public function getModel()
    {
        return new User();
    }

    public function getFilter()
    {
        return new UsersFilter();
    }

    /**
     * @param RegistrationForm $form
     * @return User|bool
     * @throws Exception
     */
    public function register(RegistrationForm $form)
    {
        if (!$form->validate()) {
            return false;
        }

        $user = new User();
        $user->name = $form->name;
        $user->password_hash = Yii::$app->security->generatePasswordHash($form->password);
        $user->email = $form->email;
        $user->email_confirmed = 0;
        $user->roles = $form->roles;
        $user->hash = Yii::$app->security->generateRandomString();
        $user->save();

        $this->onlineUsersService->generateStatus($user);
        $this->userTokensService->generateAuthToken($user);
        $this->profilesService->createProfile($user);

        return $user;
    }

    /**
     * @param AuthForm $form
     * @return bool
     * @throws NotFoundHttpException
     */
    public function login(AuthForm $form)
    {
        if (!$form->validate()) {
            return false;
        }

        /* @var $user User */
        $user = User::find()->where([
            'name' => $form->username
        ])->with([
            'authToken'
        ])->one();

        if (!$user) {
            throw new NotFoundHttpException('Пользователь не найден');
        }

        $duration = 0;

        if ($form->rememberMe) {
            $duration = 60*60*24;
        }

        return $this->webUser->login($user, $duration);
    }

    /**
     * @param array $roles
     * @param bool $strict
     * @return bool
     */
    public function isGranted(array $roles, bool $strict = true)
    {
        if ($this->webUser->isGuest) {
            return false;
        }

        $isGranted = true;
        $userRoles = $this->getRoles();

        if (array_search('ROLE_SUPER_ADMIN', $userRoles)) {
            return true;
        }

        foreach ($roles as $role) {

            if (!array_search($role, $userRoles)) {
                $isGranted = false;
            }

            if ($strict && !$isGranted) {
                break;
            }
        }

        return $isGranted;
    }

    private function getRoles()
    {
        if (is_null($this->roles)) {
            $this->roles = $this->webUser->identity->getRoles();
        }

        return $this->roles;
    }

    public function findByUsername(string $username)
    {
        if ($username === $this->webUser->identity->name) {
            return $this->webUser->identity;
        }

        return User::find()->where([
            'users.name' => $username
        ])->joinWith([
            'online',
            'profile'
        ])->one();
    }

    public function changePassword(PasswordChangeForm $form)
    {
        if (!$form->validate()) {
            return false;
        }

        /** @var User $identity */
        $identity = $this->webUser->identity;

        $identity->password_hash = Yii::$app->security->generatePasswordHash($form->new_password);
        return $identity->save();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->with(['profile']);
    }
}
