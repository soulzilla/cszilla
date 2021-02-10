<?php

namespace app\enums;

use app\components\core\Enum;

class MatchResultEnum extends Enum
{
    const STATE_NEW = 0;
    const STATE_IN_PROGRESS = 1;
    const STATE_DONE = 2;
}
