<?php

/* @var $publicationsCount int */
/* @var $likesCount int */
/* @var $viewsCount int */
/* @var $usersCount int */

$this->title = 'CSZilla Dashboard'
?>
<div class="dashboard-default-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $publicationsCount ?></h3>

                    <p>Публикаций</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $likesCount ?></h3>

                    <p>Лайков</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $viewsCount ?></h3>

                    <p>Просмотров</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $usersCount ?></h3>

                    <p>Пользователей</p>
                </div>
            </div>
        </div>
    </div>
</div>
