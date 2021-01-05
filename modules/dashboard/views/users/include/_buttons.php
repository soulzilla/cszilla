<?php

use app\models\User;
use yii\bootstrap\Html;

/* @var $model User */
?>

<p>
    <?= Html::a('Модерация', ['/dashboard/users/update', 'id' => $model->getId()], ['class' => 'btn btn-primary']) ?>
    <?php if ($model->is_blocked): ?>
        <?= Html::a('Разблокировать', ['/dashboard/users/unblock', 'id' => $model->getId()], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Вы уверены, что хотите разблокировать пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    <?php else: ?>
        <?= Html::a('Заблокировать', ['/dashboard/users/block', 'id' => $model->getId()], [
            'class' => 'btn btn-warning',
            'data' => [
                'confirm' => 'Вы уверены, что хотите заблокировать пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
    <?php if ($model->is_deleted): ?>
        <?= Html::a('Восстановить', ['/dashboard/users/restore', 'id' => $model->getId()], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите восстановить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    <?php else: ?>
        <?= Html::a('Удалить', ['/dashboard/users/delete', 'id' => $model->getId()], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif; ?>
</p>
