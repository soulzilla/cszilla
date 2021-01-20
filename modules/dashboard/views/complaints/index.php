<?php

use yii\data\ActiveDataProvider;

/** @var $provider ActiveDataProvider */

$this->title = 'Жалобы';
?>

<?= $this->render('@app/modules/dashboard/views/common/moderation_index', ['provider' => $provider, 'bodyAttribute' => 'body']) ?>
