<?php

namespace app\widgets\comments;

use app\models\Overview;
use yii\bootstrap4\Widget;

class Overviews extends Widget
{
    public $entity;

    public function run()
    {
        $overview = new Overview();
        $overview->entity_id = $this->entity->id;
        $overview->entity_table = $this->entity->tableName();

        return $this->render('overviews', [
            'overview' => $overview
        ]);
    }
}
