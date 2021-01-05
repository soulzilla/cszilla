<?php

use yii\bootstrap\Collapse;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $provider yii\data\ActiveDataProvider */
/* @var $filter app\filters\UsersFilter */

$this->title = 'Пользователи';
?>

<div class="container">
    <?= Collapse::widget([
        'items' => [
            [
                'label' => 'Фильтр',
                'content' => $this->render('include/_filter', ['filter' => $filter])
            ]
        ]
    ]) ?>

    <p>
        <a href="<?= Url::to(['/dashboard/users/registration']) ?>" class="btn btn-success">
            Создать нового пользователя
        </a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'id',
            'name',
            'email',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]) ?>
</div>
