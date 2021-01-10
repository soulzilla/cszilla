<?php

use app\components\helpers\Url;
use app\widgets\auth\Auth;
use yii\bootstrap4\Html;

if (Yii::$app->user->isGuest) {
    echo Auth::widget();
}
?>

<a href="<?= Url::to(['/main/default/index']) ?>">
    <?= Html::img('/images/logo.png', [
        'alt' => 'logo'
    ]) ?>
</a>
<ul class="main-menu">
    <?php foreach ($items as $item): ?>
        <li>
            <a href="<?= Url::to($item['url']) ?>">
                <?= $item['name'] ?>
            </a>
        </li>
    <?php endforeach; ?>
    <?php if (Yii::$app->usersService->isGranted(['ROLE_ADMIN'])): ?>
        <li>
            <a href="<?= Url::to(['/dashboard']) ?>">
                Админка
            </a>
        </li>
    <?php endif; ?>
    <?php if (Yii::$app->user->isGuest): ?>
        <li>
            <a href="#" data-toggle="modal" data-target="#auth-modal">
                Войти
            </a>
        </li>
    <?php else: ?>
        <li>
            <a href="<?= Url::to(['/main/default/profile', 'username' => Yii::$app->user->identity->name]) ?>">
                Профиль
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['/main/default/logout']) ?>" data-method="post">
                Выйти
            </a>
        </li>
    <?php endif; ?>
</ul>
