<?php

namespace app\traits;

use app\models\Attachment;
use app\models\Complaint;
use app\models\Counter;
use app\models\Like;
use app\models\Overview;
use app\models\Rating;
use app\models\View;
use Yii;

/**
 * Trait CounterTrait
 * @package app\traits
 *
 * @property View[] $views
 * @property Like[] $likes
 * @property Rating[] $ratings
 * @property Rating $rating
 * @property Counter $counter
 * @property Attachment[] $attachedItems
 */
trait CounterTrait
{
    public $attachments;

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $counter = new Counter();
            $counter->entity_id = $this->id;
            $counter->entity_table = $this->tableName();
            $counter->save();
        }

        Attachment::deleteAll(['entity_id' => $this->id, 'entity_table' => $this->tableName()]);

        if ($this->attachments) {
            foreach ($this->attachments as $attachment) {
                $attachmentModel = new Attachment();
                $attachmentModel->entity_id = $this->id;
                $attachmentModel->entity_table = $this->tableName();
                $attachmentModel->type = $attachment['type'];
                $attachmentModel->source = $attachment['source'];
                $attachmentModel->save();
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function addView()
    {
        $cacheKey = 'views-' . $this->tableName() . '-' . $this->id . '-' . Yii::$app->session->id;
        if (!Yii::$app->cache->exists($cacheKey)) {
            $view = new View();
            $view->user_id = Yii::$app->user->isGuest ? -1 : Yii::$app->user->id;
            $view->session_id = Yii::$app->session->id;
            $view->entity_id = $this->id;
            $view->entity_table = $this->tableName();
            $view->save();
            $this->updateCounter('views');
            Yii::$app->cache->set($cacheKey, 1, 1200);
        }
    }

    public function updateCounter($column)
    {
        $count = 0;
        if ($column == 'views') {
            $count = View::find()->where([
                'entity_id' => $this->id,
                'entity_table' => $this->tableName()
            ])->count();
        }

        if ($column == 'likes') {
            $count = Like::find()->where([
                'entity_id' => $this->id,
                'entity_table' => $this->tableName()
            ])->count();
        }

        if ($column == 'complaints') {
            $count = Complaint::find()->where([
                'entity_id' => $this->id,
                'entity_table' => $this->tableName()
            ])->count();
        }

        if ($column == 'overviews') {
            $count = Overview::find()->where([
                'entity_id' => $this->id,
                'entity_table' => $this->tableName()
            ])->count();
        }

        Counter::updateAll([
            $column => $count
        ], [
            'entity_id' => $this->id,
            'entity_table' => $this->tableName()
        ]);
    }

    public function getCounter()
    {
        return $this->hasOne(Counter::class, ['entity_id' => 'id'])
            ->onCondition([
                'counters.entity_table' => $this->tableName()
            ]);
    }

    public function getViews()
    {
        return $this->hasMany(View::class, [
            'entity_id' => 'id'
        ])->onCondition([
            'views.entity_table' => $this->tableName()
        ]);
    }

    public function getLikes()
    {
        return $this->hasMany(Like::class, [
            'entity_id' => 'id'
        ])->onCondition([
            'likes.entity_table' => $this->tableName()
        ]);
    }

    public function getRatings()
    {
        return $this->hasMany(Rating::class, [
            'entity_id' => 'id'
        ])->onCondition([
            'ratings.entity_table' => $this->tableName()
        ]);
    }

    public function getLike()
    {
        return $this->hasOne(Like::class, [
            'entity_id' => 'id'
        ])->onCondition([
            'likes.entity_table' => $this->tableName(),
            'likes.user_id' => Yii::$app->user->id,
            'likes.is_deleted' => 0
        ]);
    }

    public function getRating()
    {
        return $this->hasOne(Rating::class, [
            'entity_id' => 'id'
        ])->onCondition([
            'ratings.entity_table' => $this->tableName(),
            'ratings.user_id' => Yii::$app->user->id
        ]);
    }

    public function getAttachedItems()
    {
        return $this->hasMany(Attachment::class, ['entity_id' => 'id'])->onCondition(['attachments.entity_table' => $this->tableName()]);
    }
}
