<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * Class Gallery
 * @package app\models
 *
 * @property int $id
 * @property string $url
 */
class Gallery extends ActiveRecord
{
    public $file;

    public function rules()
    {
        return [
            ['url', 'string'],
            ['file', 'file']
        ];
    }
}
