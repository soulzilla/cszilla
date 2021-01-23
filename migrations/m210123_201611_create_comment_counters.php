<?php

use app\components\core\Migration;
use app\models\Comment;
use app\models\Counter;

/**
* Class m210123_201611_create_comment_counters
*/
class m210123_201611_create_comment_counters extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $comments = Comment::find()->all();

        if ($comments) {
            foreach ($comments as $comment) {
                $counter = new Counter();
                $counter->entity_table = $comment->tableName();
                $counter->entity_id = $comment->id;
                $counter->save();
            }
        }
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        echo "m210123_201611_create_comment_counters cannot be reverted.\n";

        return false;
    }
}
