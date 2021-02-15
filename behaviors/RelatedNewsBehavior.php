<?php

namespace app\behaviors;

use app\components\core\ActiveRecord;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use app\models\RelatedPublication;
use yii\base\Behavior;
use yii\base\Component;

class RelatedNewsBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
        ];
    }

    public function afterSave()
    {
        $owner = $this->getOwner();

        RelatedPublication::deleteAll([
            'entity_id' => $owner->getPrimaryKey(),
            'entity_table' => $owner->tableName()
        ]);

        if ($owner->related_publications) {
            foreach ($owner->related_publications as $publication) {
                $relatedPublication = new RelatedPublication();
                $relatedPublication->entity_id = $owner->getPrimaryKey();
                $relatedPublication->entity_table = $owner->tableName();
                $relatedPublication->publication_id = $publication;
                $relatedPublication->save();
            }
        }
    }

    /**
     * @return Component|Bookmaker|Casino|LootBox|null
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
