<?php

namespace app\commands;

class MigrateController extends \yii\console\controllers\MigrateController
{
    public $templateFile = '@app/components/templates/migration.php';

    public $generatorTemplateFiles = [
        'create_table' => '@app/components/templates/migration.php',
        'drop_table' => '@app/components/templates/migration.php',
        'add_column' => '@app/components/templates/migration.php',
        'drop_column' => '@app/components/templates/migration.php',
        'create_junction' => '@app/components/templates/migration.php',
    ];
}