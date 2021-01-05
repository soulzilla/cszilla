<?php

/* @var $this yii\web\View */

use app\components\helpers\Url;
use app\widgets\banners\Banners;

/* @var $provider yii\data\ActiveDataProvider */
/* @var $models app\models\Contest[] */

$this->title = 'Розыгрыши на сайте CS:GO Heaven';

$models = $provider->getModels();
$this->render('@app/components/templates/meta');
?>

<section class="page-top-section set-bg" data-setbg="/images/give_bg.jpg">
    <div class="container">
        <h2>Розыгрыши</h2>
    </div>
</section>

<section class="blog-list-section pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box mb-3">
                <div class="small-blog-list">
                    <?php if (sizeof($models)): $lastKey = array_key_last($models); ?>
                        <?php foreach ($models as $key => $model): ?>
                            <div class="sb-item">
                                <div class="sb-text">
                                    <?= $model->description ?>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                                                Подробнее
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php if ($key != $lastKey): ?>
                            <hr/>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>
                            Розыгрыши недоступны
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <?= Banners::widget() ?>
            </div>
        </div>
    </div>
</section>
