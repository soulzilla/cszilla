<?php

namespace app\behaviors;

use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\models\Bonus;
use app\models\Notification;
use app\models\PromoCode;
use app\models\Publication;
use yii\base\Behavior;
use yii\base\Component;

class NotificationBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave'
        ];
    }

    public function afterSave()
    {
        if ($this->getOwner()->is_published) {
            $notification = new Notification();
            $notification->target_id = -1;
            $notification->content = $this->getContentForType();
            $notification->source_id = $this->getSourceByType();
            $notification->source_table = $this->getTableByType();
            $notification->source_key = $this->getKeyByType();
            $notification->save();
        }
    }

    /**
     * @return Component|PromoCode|Bonus|Publication
     */
    public function getOwner()
    {
        return $this->owner;
    }

    private function getContentForType()
    {
        switch ($this->getOwner()->tableName()) {
            case 'publications':
                return 'Новая публикация "' . $this->getOwner()->title . '"';
            case 'bonuses':
                return 'Успейте получить бонус';
            case 'promo_codes':
                return 'Успейте активировать промо код';
        }

        return '';
    }

    private function getSourceByType()
    {
        switch ($this->getOwner()->tableName()) {
            case 'publications':
                return $this->getOwner()->category->id;
            case 'bonuses':
            case 'promo_codes':
                return $this->getOwner()->entity_id;
        }

        return -1;
    }

    private function getTableByType()
    {
        switch ($this->getOwner()->tableName()) {
            case 'publications':
                return 'categories';
            case 'bonuses':
            case 'promo_codes':
                return $this->getOwner()->entity_table;
        }

        return '';
    }

    private function getKeyByType()
    {
        switch ($this->getOwner()->tableName()) {
            case 'publications':
                return $this->getOwner()->title_canonical;
            case 'bonuses':
                return Url::to(['/main/bonuses/view', 'id' => $this->getOwner()->id]);
            case 'promo_codes':
                return Url::to(['/main/promos/view', 'id' => $this->getOwner()->id]);
        }

        return '';
    }
}
