<?php

namespace app\components\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function array_diff_assoc($array1, $array2, $recursive = false)
    {
        $diff = array_diff_assoc($array1, $array2);

        if (!$recursive) {
            return $diff;
        }

        foreach ($array1 as $key => $value) {
            if (!is_array($value)) {
                continue;
            }
            if (self::isAssociative($value)) {
                $innerDiff = array_diff_assoc($value, $array2[$key]);
                if (!sizeof($innerDiff)) {
                    $innerDiff = array_diff_assoc($array2[$key], $value);
                }
            } else {
                $innerDiff = array_diff($value, $array2[$key]);
                if (!sizeof($innerDiff)) {
                    $innerDiff = array_diff($array2[$key], $value);
                }
            }
            if (sizeof($innerDiff)) {
                $diff[$key] = $value;
            }
        }

        return $diff;
    }
}