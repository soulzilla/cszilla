<?php

namespace app\commands;

use app\components\core\ActiveRecord;
use app\enums\RolesEnum;
use app\forms\RegistrationForm;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\GameMatch;
use app\models\Like;
use app\models\LootBox;
use app\models\Page;
use app\models\Publication;
use app\models\User;
use app\models\View;
use app\services\UsersService;
use Faker\Factory;
use yii\console\Controller;
use yii\db\Expression;

class EmulateController extends Controller
{
    private $dailyLimit = 1;
    private $publicationsLimit = 10;
    private $matchesLimit = 10;
    private $ratingsLimit = 3;
    private $usersService;
    private $factory;

    public function __construct($id, $module,
                                UsersService $usersService,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->usersService = $usersService;
        $this->factory = Factory::create('ru_RU');
    }

    public function actionIndex()
    {
        $factory = $this->factory;

        for ($i = 0; $i <= $this->dailyLimit; $i++) {
            $form = new RegistrationForm();
            $name = str_replace('.', '_', $factory->userName);
            while (strlen($name) < 6 || strlen($name) > 15) {
                $name = str_replace('.', '_', $factory->userName);
            }
            $form->name = $name;
            $form->password = $name;
            $form->email = $name . '@' . $factory->safeEmailDomain;
            $form->roles = [
                RolesEnum::ROLE_EMULATED => 'ROLE_EMULATED'
            ];
            $this->usersService->register($form);
        }

        $users = User::find()->where(['roles' => '{"10000":"ROLE_EMULATED"}'])->all();

        foreach ($users as $user) {
            $this->emulatePublications($user);
            $this->emulateMatches($user);
            $this->emulatePartners($user);
            $this->emulatePages($user);
        }
    }

    private function emulatePublications(User $user)
    {
        $publications = Publication::find()
            ->orderBy(new Expression('random()'))
            ->andWhere(['is_published' => 1, 'is_deleted' => 0, 'is_blocked' => 0])
            ->with(['counter'])
            ->limit($this->publicationsLimit)
            ->all();

        foreach ($publications as $publication) {
            $this->addView($publication, $user);
            $this->addLike($publication, $user);
        }
    }

    private function emulateMatches(User $user)
    {
        $matches = GameMatch::find()
            ->orderBy(new Expression('random()'))
            ->addOrderBy(['start_ts' => SORT_DESC])
            ->with(['counter'])
            ->limit($this->matchesLimit)
            ->all();

        foreach ($matches as $match) {
            $this->addView($match, $user);
            $this->addLike($match, $user);
        }
    }

    public function emulatePartners(User $user)
    {
        $lootBoxes = LootBox::find()
            ->orderBy(new Expression('random()'))
            ->limit($this->ratingsLimit)
            ->with(['counter'])
            ->all();

        $casinos = Casino::find()
            ->orderBy(new Expression('random()'))
            ->limit($this->ratingsLimit)
            ->with(['counter'])
            ->all();

        $bookmakers = Bookmaker::find()
            ->orderBy(new Expression('random()'))
            ->limit($this->ratingsLimit)
            ->with(['counter'])
            ->all();

        foreach ($lootBoxes as $lootBox) {
            $this->addView($lootBox, $user);
            $this->addLike($lootBox, $user);
        }

        foreach ($casinos as $casino) {
            $this->addView($casino, $user);
            $this->addLike($casino, $user);
        }

        foreach ($bookmakers as $bookmaker) {
            $this->addView($bookmaker, $user);
            $this->addLike($bookmaker, $user);
        }
    }

    private function emulatePages(User $user)
    {
        $pages = Page::find()->all();
        foreach ($pages as $page) {
            $this->addView($page, $user);
            $this->addLike($page, $user);
        }
    }

    private function addView(ActiveRecord $entity, User $user)
    {
        $view = new View();
        $view->user_id = $user->id;
        $view->entity_table = $entity->tableName();
        $view->entity_id = $entity->getPrimaryKey();
        $view->session_id = session_create_id();
        $view->save();
        $counter = $entity->counter;
        $counter->views = $counter->views + 1;
        $counter->save();
    }

    private function addLike($entity, $user)
    {
        if (Like::find()->where([
            'user_id' => $user->id,
            'entity_id' => $entity->getPrimaryKey(),
            'entity_table' => $entity->tableName()
        ])->exists()) {
            return;
        }

        $like = new Like();
        $like->user_id = $user->id;
        $like->entity_table = $entity->tableName();
        $like->entity_id = $entity->getPrimaryKey();
        $like->save();

        $counter = $entity->counter;
        $counter->likes = $counter->likes + 1;
        $counter->save();
    }
}
