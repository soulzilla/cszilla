<?php

namespace app\services;

use app\components\core\Service;
use app\models\Like;
use Yii;

class LikesService extends Service
{
    public function getModel()
    {
        return new Like();
    }

    public function like($recordId, $recordTable)
    {
        /* @var $like Like */
        $like = Like::find()->where([
            'entity_id' => $recordId,
            'entity_table' => $recordTable,
            'user_id' => Yii::$app->user->id
        ])->one();

        if ($like) {
            if ($like->is_deleted) {
                $like->restore();
                $event = 1;
            } else {
                $like->delete();
                $event = 2;
            }
        } else {
            $like = $this->getModel();
            $like->entity_id = $recordId;
            $like->entity_table = $recordTable;
            $like->user_id = Yii::$app->user->id;
            $like->save();
            $event = 1;
        }

        $count = Like::find()->where([
            'entity_id' => $recordId,
            'entity_table' => $recordTable,
            'is_deleted' => 0
        ])->count();

        return [
            'count' => $count,
            'event' => $event
        ];
    }
}
