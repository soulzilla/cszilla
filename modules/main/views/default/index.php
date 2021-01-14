<?php

use app\components\helpers\{StringHelper, Url};
use app\enums\StaticBlockEnum;
use app\models\{Publication, Bookmaker, Casino, LootBox, Review};
use app\widgets\{banners\Banners,
    categories\Categories,
    comments\Comments,
    contests\Contests,
    reviews\Reviews,
    stream\Stream,
    top\Top,
    videos\Videos};
use yii\web\View;

/* @var $this View */
/* @var $publications Publication[] */
/* @var $reviews Review[] */
/* @var $bookmakers Bookmaker[] */
/* @var $casinos Casino[] */
/* @var $lootBoxes LootBox[] */

$this->title = 'CS:GO Heaven - Лучший сайт';
$this->registerMetaTag([
    'name' => 'title',
    'content' => $this->title
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'CS:GO Heaven - лучший сайт по игре'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'cs, csgo, counter strike, халява, бонусы, промокоды'
]);
?>

<section class="blog-list-section py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 blog-posts bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <div class="blog-post featured-post">
                    <h2 class="text-white mb-3"><?= Yii::$app->name ?></h2>
                    <?= Yii::$app->staticBlocksService->getMainDescription()->content; ?>
                    <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                        <a href="<?= Url::to(['/dashboard/static/update', 'type' => StaticBlockEnum::TYPE_MAIN_DESCRIPTION]) ?>"
                           class="text-white">
                            <i class="fa fa-pencil"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <h3 class="text-white mb-3">Публикации</h3>
                <div class="row">
                    <?php foreach ($publications as $publication): ?>
                        <div class="col-md-6">
                            <div class="blog-post">
                                <h4><?= $publication->title ?></h4>
                                <div class="post-date" style="background-color: <?= $publication->category->color ?>">
                                    <?= StringHelper::humanize($publication->publish_date) ?>
                                </div>
                                <div class="post-metas">
                                    <div class="post-meta">
                                        <a href="<?= Url::to(['/main/news/index', 'category' => $publication->category_id]) ?>">
                                            <?= $publication->category->name ?>
                                        </a>
                                    </div>
                                    <div class="post-meta"><?= $publication->author->name ?></div>
                                </div>
                                <p><?= $publication->announce ?></p>
                                <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $publication->title_canonical]) ?>"
                                   class="site-btn">Подробнее</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <?= Categories::widget() ?>

                <?= Videos::widget() ?>

                <?= Stream::widget() ?>

                <?= Contests::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="blog-list-section pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <h2 class="text-white mb-3">Букмекеры</h2>
                <div class="small-blog-list">
                    <?php if (sizeof($bookmakers)): ?>
                        <?php foreach ($bookmakers as $bookmaker): ?>
                            <div class="sb-item">
                                <img src="<?= $bookmaker->logo ?>" alt="<?= $bookmaker->name_canonical ?>">
                                <div class="sb-text">
                                    <h6><?= $bookmaker->name ?></h6>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/bookmakers/view', 'name_canonical' => $bookmaker->name_canonical]) ?>">Подробнее</a>
                                        </div>
                                        <?php if ($bookmaker->bonus): ?>
                                            <div class="sb-meta">
                                                <a href="<?= Url::to(['/main/bonuses/view', 'id' => $bookmaker->bonus->id]) ?>">Получить
                                                    бонус</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?= $bookmaker->description ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Список букмекеров недоступен.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <?= Banners::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="blog-list-section pb-0 pb-lg-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <h2 class="text-white mb-3">Сайты с лут-боксами</h2>
                <div class="small-blog-list">
                    <?php if (sizeof($lootBoxes)): ?>
                        <?php foreach ($lootBoxes as $lootBox): ?>
                            <div class="sb-item">
                                <img src="<?= $lootBox->logo ?>" alt="<?= $lootBox->name_canonical ?>">
                                <div class="sb-text">
                                    <h6><?= $lootBox->name ?></h6>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/loot-boxes/view', 'name_canonical' => $lootBox->name_canonical]) ?>">Подробнее</a>
                                        </div>
                                        <?php if ($lootBox->promoCode): ?>
                                            <div class="sb-meta">
                                                <a href="<?= Url::to(['/main/promos/view', 'id' => $lootBox->promoCode->id]) ?>">Промокод</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?= $lootBox->description ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Список сайтов с кейсами недоступен.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <?= Top::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="blog-list-section pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <h2 class="text-white mb-3">Казино</h2>
                <div class="small-blog-list">
                    <?php if (sizeof($casinos)): ?>
                        <?php foreach ($casinos as $casino): ?>
                            <div class="sb-item">
                                <img src="<?= $casino->logo ?>" alt="<?= $casino->name_canonical ?>">
                                <div class="sb-text">
                                    <h6><?= $casino->name ?></h6>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/casinos/view', 'name_canonical' => $casino->name_canonical]) ?>">Подробнее</a>
                                        </div>
                                        <?php if ($casino->promoCode): ?>
                                            <div class="sb-meta">
                                                <a href="<?= Url::to(['/main/promos/view', 'id' => $casino->promoCode->id]) ?>">
                                                    Промокод
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?= $casino->description ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Список казино недоступен.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4">
                <?= Comments::widget() ?>
            </div>
        </div>
    </div>
</section>

<section class="testimonials-section pt-0">
    <div class="container pl-3 pl-lg-0">
        <div class="bordered-box">
            <div class="game-title">
                <h2>Отзывы</h2>
            </div>
            <?php if ($reviews): ?>
                <div class="testimonial-slider owl-carousel">
                    <?php foreach ($reviews as $review): ?>
                        <div class="testimonial">
                            <div class="testimonial-text">
                                <div class="test-date"><?= date('d/m/Y', strtotime($review->ts)) ?></div>
                                <p><?= $review->content ?></p>
                            </div>
                            <div class="testimonial-info">
                                <div class="ti-text">
                                    <h5><?= $review->author->name ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>
                    К сожалению, отзывов пока нет. Вы можете быть первым!
                </p>
            <?php endif; ?>
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Reviews::widget() ?>
                <div class="row mt-3">
                    <a href="#" class="site-btn ml-auto mr-3" data-toggle="modal" data-target="#review-modal">
                        Оставить отзыв
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
