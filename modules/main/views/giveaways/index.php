<?php

/* @var $this yii\web\View */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\widgets\banners\Banners;
use app\widgets\pager\Pager;

/* @var $provider yii\data\ActiveDataProvider */
/* @var $models app\models\Contest[] */

$this->title = 'Розыгрыши на сайте CSZilla';

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
            <div class="col-lg-8 bordered-box mb-3 mx-3 mx-lg-0 text-break">
                <div class="small-blog-list">
                    <?php if (sizeof($models)): $lastKey = array_key_last($models); ?>
                        <?php foreach ($models as $key => $model): ?>
                            <div class="sb-item">
                                <div class="sb-text">

                                    <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                                        <h6>Розыгрыш - <?= StringHelper::humanize($model->date_start) ?></h6>
                                    </a>

                                    <?= $model->description ?>
                                </div>
                            </div>
                            <?php if ($key != $lastKey): ?>
                                <hr/>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <?= Pager::widget([
                            'pagination' => $provider->pagination
                        ]) ?>
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
