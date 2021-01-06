<?php

use Symfony\Component\VarDumper\VarDumper;

if (file_exists('DEV')) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
} elseif (file_exists('TEST')) {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'test');
} else {
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

if (defined('YII_DEBUG') && YII_DEBUG) {
    function dump($var, ...$vars) {
        echo '<pre>';
        VarDumper::dump($var);

        foreach ($vars as $v) {
            VarDumper::dump($v);
        }
        echo '</pre>';

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }

    function dd(...$vars) {
        foreach ($vars as $var) {
            dump($var);
        }

        die(1);
    }
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
