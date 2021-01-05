<?php

/* @var $model User */

use app\models\User;
use app\enums\YesOrNoEnum;
use yii\bootstrap\Collapse;
use yii\widgets\DetailView;

$this->title = 'Пользователь: ' . $model->name;
?>

<div class="container">
    <?= Collapse::widget([
        'items' => [
            [
                'label' => 'Действия',
                'content' => $this->render('include/_buttons', ['model' => $model])
            ]
        ]
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                'name',
            'email',
            [
                'label' => 'Заблокирован',
                'value' => YesOrNoEnum::label($model->is_blocked)
            ],
            [
                'label' => 'Удалён',
                'value' => YesOrNoEnum::label($model->is_deleted)
            ]
        ]
    ]) ?>

</div>
