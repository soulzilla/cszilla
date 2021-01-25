<?php

namespace app\widgets\nav;

use app\components\core\Controller;
use app\models\Notification;
use Yii;
use yii\bootstrap4\Widget;

class Nav extends Widget
{
    /** @var Controller */
    public $currentController;

    private $notifications = [];

    private $hasNotifications = false;

    public function run()
    {
        if ($this->currentController->action->id == 'error') {
            return '';
        }

        $socialLinks = Yii::$app->staticBlocksService->getSocialLinks();

        $categories = Yii::$app->categoriesService->getModel()::find()
            ->where(['categories.is_published' => 1])
            ->joinWith(['counter'])
            ->orderBy(['categories.order' => SORT_ASC])
            ->cache(300)
            ->all();

        $this->getNotifications();

        return $this->render('index', [
            'currentController' => $this->currentController,
            'socialLinks' => $socialLinks,
            'categories' => $categories,
            'notifications' => $this->notifications,
            'hasNotifications' => $this->hasNotifications
        ]);
    }

    private function getNotifications()
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $observers = Yii::$app->user->identity->observers;

        $query = Notification::find()->andWhere([
            'notifications.target_id' => Yii::$app->user->id
        ]);

        if (sizeof($observers)) {
            foreach ($observers as $observer) {
                $query->orWhere([
                    'AND',
                    [
                        'notifications.target_id' => -1,
                        'notifications.source_id' => $observer->entity_id,
                        'notifications.source_table' => $observer->entity_table
                    ],
                    [
                        '>', 'notifications.ts', $observer->ts
                    ]
                ]);
            }
        }

        $query->joinWith(['status'])->orderBy(['notifications.ts' => SORT_DESC])->limit(5);
        $query->cache(300);

        /** @var Notification[] $notifications */
        $notifications = $query->all();

        if (sizeof($notifications)) {
            foreach ($notifications as $notification) {
                if (!$notification->status) {
                    $this->hasNotifications = true;
                    $notification->createStatus();
                }
            }

            $this->notifications = $notifications;
        }
    }
}
