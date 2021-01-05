<?php

use app\components\helpers\Url;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models Bookmaker[]|Casino[]|LootBox[] */

$models = $provider->getModels();
?>

<section class="blog-list-section pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box mb-3">
                <?php foreach ($models as $key => $model): ?>
                    <div class="character-info">
                        <h2><?= $model->name ?></h2>
                        <?= $model->description ?>
                        <?php if ($model instanceof Bookmaker) $url = Url::to(['/main/bookmakers/view', 'name_canonical' => $model->name_canonical]) ?>
                        <?php if ($model instanceof Casino) $url = Url::to(['/main/casinos/view', 'name_canonical' => $model->name_canonical]) ?>
                        <?php if ($model instanceof LootBox) $url = Url::to(['/main/loot-boxes/view', 'name_canonical' => $model->name_canonical]) ?>
                        <a href="<?= $url ?>" class="site-btn">Подробнее</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
