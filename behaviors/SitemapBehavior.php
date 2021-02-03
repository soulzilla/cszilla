<?php

namespace app\behaviors;

use app\components\core\ActiveRecord;
use app\models\{Bonus, Bookmaker, Casino, Category, LootBox, PromoCode, Publication, Sitemap};
use yii\base\Behavior;

class SitemapBehavior extends Behavior
{
    /** @var Publication|Category|Bookmaker|Casino|LootBox|PromoCode|Bonus */
    public $owner;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'generate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'generate',
            ActiveRecord::EVENT_AFTER_DELETE => 'remove',
        ];
    }

    public function generate()
    {
        if (!$this->owner->is_published) {
            $this->remove();
            return;
        }

        if ($this->owner->hasAttribute('is_deleted') && $this->owner->getAttribute('is_deleted')) {
            $this->remove();
            return;
        }

        if ($this->owner->hasAttribute('is_blocked') && $this->owner->getAttribute('is_blocked')) {
            $this->remove();
            return;
        }

        $model = Sitemap::find()->where([
            'entity_id' => $this->owner->id,
            'entity_table' => $this->owner->tableName()
        ])->one();

        if (!$model) {
            $model = new Sitemap();
            $model->entity_id = $this->owner->id;
            $model->entity_table = $this->owner->tableName();
            $model->url = $this->owner->getSitemapUrl();
        }

        $model->last_mod = date('Y-m-d');
        $model->save();
    }

    public function remove()
    {
        return Sitemap::deleteAll([
            'entity_id' => $this->owner->id,
            'entity_table' => $this->owner->tableName()
        ]);
    }
}
