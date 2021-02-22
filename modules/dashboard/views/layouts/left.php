<?php
/* @var $directoryAsset string */

use dmstr\widgets\Menu;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?= Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
            'items' => [
                [
                    'label' => 'Пользователи',
                    'icon' => 'users',
                    'url' => ['/dashboard/users/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SPECIAL_USERS']),
                    'options' => [
                        'class' => $this->context->id == 'users' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Посты',
                    'icon' => 'newspaper-o',
                    'url' => ['/dashboard/publications/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'news' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Категории постов',
                    'icon' => 'cog',
                    'url' => ['/dashboard/categories/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'categories' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Матч-центр',
                    'icon' => 'share',
                    'url' => '#',
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_MODERATOR']),
                    'items' => [
                        ['label' => 'Команды', 'icon' => 'users', 'url' => ['/dashboard/teams/index']],
                        ['label' => 'Матчи', 'icon' => 'plus', 'url' => ['/dashboard/matches/index']],
                        ['label' => 'Задания', 'icon' => 'plus', 'url' => ['/dashboard/tasks/index']]
                    ]
                ],
                [
                    'label' => 'Турниры',
                    'icon' => 'share',
                    'url' => '#',
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'items' => [
                        ['label' => 'Список', 'icon' => 'trophy', 'url' => ['/dashboard/tournaments/index']],
                        ['label' => 'Матчи', 'icon' => 'plus', 'url' => ['/dashboard/tmatches/index']]
                    ]
                ],
                [
                    'label' => 'Букмекеры',
                    'icon' => 'money',
                    'url' => ['/dashboard/bookmakers/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'bookmakers' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Рулетки',
                    'icon' => 'diamond',
                    'url' => ['/dashboard/casinos/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'casino' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Loot-боксы',
                    'icon' => 'dropbox',
                    'url' => ['/dashboard/roulette/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'roulette' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Бонусы',
                    'icon' => 'dollar',
                    'url' => ['/dashboard/bonuses/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'bonuses' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Промокоды',
                    'icon' => 'qrcode',
                    'url' => ['/dashboard/promos/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'promos' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Розыгрыши',
                    'icon' => 'gift',
                    'url' => ['/dashboard/contests/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'contests' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Призы',
                    'icon' => 'ticket',
                    'url' => ['/dashboard/prizes/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'prizes' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Баннеры',
                    'icon' => 'list',
                    'url' => ['/dashboard/banners/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'banners' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Отзывы',
                    'icon' => 'list',
                    'url' => ['/dashboard/reviews/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'options' => [
                        'class' => $this->context->id == 'reviews' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Бегущая строка',
                    'icon' => 'list-alt',
                    'url' => ['/dashboard/tickers/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'tickers' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Статичные блоки',
                    'icon' => 'cogs',
                    'url' => ['/dashboard/static/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'static' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'FAQ',
                    'icon' => 'question',
                    'url' => ['/dashboard/faq/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'faq' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'CMS',
                    'icon' => 'book',
                    'url' => ['/dashboard/pages/index'],
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN']),
                    'options' => [
                        'class' => $this->context->id == 'pages' ? 'active' : ''
                    ]
                ],
                [
                    'label' => 'Галерея',
                    'icon' => 'share',
                    'url' => '#',
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_EDITOR']),
                    'items' => [
                        ['label' => 'Картинки', 'icon' => 'image', 'url' => ['/dashboard/images/index']],
                        ['label' => 'Видео', 'icon' => 'play', 'url' => ['/dashboard/videos/index']],
                        ['label' => 'Стримы', 'icon' => 'rss', 'url' => ['/dashboard/streams/index']]
                    ]
                ],
                [
                    'label' => 'Модерация',
                    'icon' => 'share',
                    'url' => '#',
                    'visible' => Yii::$app->usersService->isGranted(['ROLE_MODERATOR']),
                    'items' => [
                        ['label' => 'Комментарии', 'icon' => 'comments', 'url' => ['/dashboard/comments/index']],
                        ['label' => 'Обратная связь', 'icon' => 'plus', 'url' => ['/dashboard/messages/index']]
                    ]
                ]
            ],
        ]) ?>

    </section>

</aside>
