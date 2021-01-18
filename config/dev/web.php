<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '9BH6-PFGkzaEhh4I0MNPQ112r8rr8nc5',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => '/main/default/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/main/default/index',
                '<module:w+>' => '<module:w+>/default/index',
                'news/<category>' => '/main/news/index',
                'news' => '/main/news/index',
                'giveaways' => '/main/giveaways/index',
                'bookmakers' => '/main/bookmakers/index',
                'casinos' => '/main/casinos/index',
                'notifications' => '/main/notifications/index',
                'loot-boxes' => '/main/loot-boxes/index',
                'bonuses/<id>' => '/main/bonuses/view',
                'promos/<id>' => '/main/promos/view',
                'redirect/<url>' => '/main/default/redirect',
                'u/<username>' => '/main/default/profile',
                'bookmaker/<name_canonical>' => '/main/bookmakers/view',
                'casino/<name_canonical>' => '/main/casinos/view',
                'loot-box/<name_canonical>' => '/main/loot-boxes/view',
                'p/<title_canonical>' => '/main/news/view',
                '<module:[\w\-]+>/<action:[\w\-]+>' => '<module>/default/<action>',
                '<module>/<controller>/<id>/<action>' => '<module>/<controller>/<action>',
                '<module:w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];


$config['bootstrap'][] = 'debug';
$config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
];

$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    'generators' => [
        'entity' => [
            'class' => 'app\components\gii\entity\Generator'
        ]
    ]
];

$services = require __DIR__ . '/services.php';
$config['components'] = array_merge($config['components'], $services);

$modules = require __DIR__ . '/modules.php';
$config['modules'] = array_merge($config['modules'], $modules);

if (isset($_GET['force_copy']) && $_GET['force_copy'] == 1) {
    $config['components']['assetManager']['forceCopy'] = true;
}

return $config;
