<?php

namespace app\widgets\top;

use app\services\StaticBlocksService;
use yii\bootstrap4\Widget;

class Top extends Widget
{
    private $staticBlocksService;

    public function __construct(StaticBlocksService $staticBlocksService, $config = [])
    {
        parent::__construct($config);
        $this->staticBlocksService = $staticBlocksService;
    }

    public function run()
    {
        return $this->render('index', [
            'model' =>  $this->staticBlocksService->getTop()
        ]);
    }
}
