<?php

use app\components\core\Controller;
use app\components\helpers\Url;
use app\models\Category;
use app\models\Notification;
use app\models\StaticBlock;
use app\widgets\auth\Auth;

/** @var $currentController Controller */
/** @var $socialLinks StaticBlock[] */
/** @var $categories Category[] */
/** @var $notifications Notification[] */
/** @var $hasNotifications bool */

if (Yii::$app->user->isGuest) {
    echo Auth::widget();
}
?>
<header class="nk-header nk-header-opaque">

    <div class="nk-contacts-top">
        <div class="container">
            <div class="nk-contacts-left d-none d-lg-block">
                <ul class="nk-social-links">
                    <?php foreach ($socialLinks as $link): ?>
                        <li>
                            <a target="_blank" class="nk-social-<?= $link->getIcon() ?>" href="<?= $link->content ?>">
                                <span class="fa fa-<?= $link->getIcon() ?>"></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="nk-contacts-right">
                <ul class="nk-contacts-icons">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#search-modal">
                            <span class="fa fa-search fa-2x"></span>
                        </a>
                    </li>

                    <li class="<?= $currentController->action->id == 'profile' ? 'active' : '' ?>">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <a href="#" data-toggle="modal" data-target="#auth-modal">
                                <span class="fa fa-user fa-2x"></span>
                            </a>
                        <?php else: ?>
                            <a href="<?= Url::to(['/main/default/profile', 'username' => Yii::$app->user->identity->name]) ?>">
                                <span class="fa fa-user fa-2x"></span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <?php if (Yii::$app->user->isGuest === false): ?>
                        <li>
                            <span class="nk-cart-toggle">
                                <?php if ($hasNotifications): ?>
                                    <span class="nk-badge">
                                        <span class="fa fa-bell fa-2x"></span>
                                    </span>
                                <?php else: ?>
                                    <span class="far fa-bell fa-2x"></span>
                                <?php endif; ?>
                            </span>

                            <div class="nk-cart-dropdown">
                                <?php if (sizeof($notifications)): ?>
                                    <?php foreach ($notifications as $notification): ?>
                                        <div class="nk-widget-post pl-0">
                                            <a href="<?= $notification->getUrl() ?>">
                                                <div class="<?= $notification->status ? 'text-white' : 'nk-main-1' ?> nk-btn-hover-color-main-3"><?= $notification->content ?></div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </li>

                        <li>
                            <a href="<?= Url::to(['/main/default/logout']) ?>" data-method="post">
                                <span class="fa fa-sign-out fa-2x"></span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide">
        <div class="container">
            <div class="nk-nav-table">

                <a href="<?= Url::to(['/main/default/index']) ?>" class="nk-nav-logo">
                    <img src="/images/logo.png" alt="CSZilla" width="199">
                </a>

                <ul class="nk-nav nk-nav-right d-none d-lg-table-cell" data-nav-mobile="#nk-nav-mobile">
                    <li class="nk-drop-item <?= $currentController->id == 'news' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/main/news/index']) ?>">
                            Новости
                        </a>
                        <ul class="dropdown">
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a href="<?= Url::to(['/main/news/index', 'category' => $category->name_canonical]) ?>">
                                        <?= $category->name ?>
                                        <span class="nk-badge"><?= $category->counter->count ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="<?= $currentController->id == 'giveaways' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/main/giveaways/index']) ?>">
                            Розыгрыши
                        </a>
                    </li>
                    <li class="<?= $currentController->id == 'casinos' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/main/casinos/index']) ?>">
                            Рулетки
                        </a>
                    </li>
                    <li class="<?= $currentController->id == 'bookmakers' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/main/bookmakers/index']) ?>">
                            Букмекеры
                        </a>
                    </li>
                    <li class="<?= $currentController->id == 'loot-boxes' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['/main/loot-boxes/index']) ?>">
                            Лутбоксы
                        </a>
                    </li>
                </ul>

                <ul class="nk-nav nk-nav-right nk-nav-icons">

                    <li class="single-icon d-lg-none">
                        <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
                            <span class="nk-icon-burger">
                                <span class="nk-t-1"></span>
                                <span class="nk-t-2"></span>
                                <span class="nk-t-3"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>

<div id="nk-nav-mobile" class="nk-navbar nk-navbar-side nk-navbar-right-side nk-navbar-overlay-content d-lg-none">
    <div class="nano">
        <div class="nano-content">
            <a href="<?= Url::to(['/main/default/index']) ?>" class="nk-nav-logo">
                <img src="/images/logo.png" alt="" width="120">
            </a>
            <div class="nk-navbar-mobile-content">
                <ul class="nk-nav">

                </ul>
            </div>
        </div>
    </div>
</div>
