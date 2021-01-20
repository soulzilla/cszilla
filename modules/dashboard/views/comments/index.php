<?php

use yii\data\ActiveDataProvider;

/** @var $provider ActiveDataProvider */

$this->title = 'Комментарии';
?>

<?= $this->render('@app/modules/dashboard/views/common/moderation_index', ['provider' => $provider, 'bodyAttribute' => 'content']) ?>
