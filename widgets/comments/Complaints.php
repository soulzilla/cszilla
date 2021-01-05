<?php

namespace app\widgets\comments;

use app\models\Complaint;
use yii\bootstrap4\Widget;

class Complaints extends Widget
{
    public $entity;

    public function run()
    {

        $complaint = new Complaint();
        $complaint->entity_table = $this->entity->tableName();
        $complaint->entity_id = $this->entity->id;

        return $this->render('complaints', [
            'complaint' => $complaint
        ]);
    }
}
