<?php

namespace app\behaviors;

use app\components\core\ActiveRecord;
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
            $exist = Notification::find()
                ->where([
                    'source_id' => $this->getSourceByType(),
                    'source_table' => $this->getTableByType()])
                ->exists();

            if (!$exist) {
                $notification = new Notification();
                $notification->target_id = -1;
                $notification->content = $this->getContentForType();
                $notification->source_id = $this->getSourceByType();
                $notification->source_table = $this->getTableByType();
                $notification->save();
            }
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
                return 'Новая публикация <a href="/p/' . $this->getOwner()->title_canonical . '">' . $this->getOwner()->title . '</a> в разделе <a href="/news/' . $this->getOwner()->category->name_canonical . '">' . $this->getOwner()->category->name . '</a>';
            case 'bonuses':
                return 'Успейте получить <a href="/bonuses/' . $this->getOwner()->id . '">бонус</a>';
            case 'promo_codes':
                return 'Успейте активировать <a href="/promos/' . $this->getOwner()->id . '">промо код</a>';
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
}
