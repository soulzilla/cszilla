<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class ConfigureController extends Controller
{
    public function actionIndex()
    {
        $env = YII_ENV;

        $consoleFile = Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . $env . DIRECTORY_SEPARATOR . 'console.php');
        $dbFile = Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . $env . DIRECTORY_SEPARATOR . 'db.php');
        $paramsFile = Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . $env . DIRECTORY_SEPARATOR . 'params.php');
        $webFile = Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . $env . DIRECTORY_SEPARATOR . 'web.php');

        file_put_contents(Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . 'console.php'), file_get_contents($consoleFile));
        file_put_contents(Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . 'db.php'), file_get_contents($dbFile));
        file_put_contents(Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . 'params.php'), file_get_contents($paramsFile));
        file_put_contents(Yii::getAlias('@app/config' . DIRECTORY_SEPARATOR . 'web.php'), file_get_contents($webFile));
    }
}
