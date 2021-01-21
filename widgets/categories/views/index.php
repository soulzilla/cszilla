<?php

/* @var $models Category[] */

use app\components\helpers\Url;
use app\models\Category;

$searchUrl = Url::to(['/main/news/index']);
if ($category = Yii::$app->request->get('category')) {
    $searchUrl = Url::to(['/main/news/index', 'category' => $category]);
}
?>
<div class="sb-widget bordered-box mt-sm-3 mt-lg-0">
    <h2 class="sb-title">Разделы</h2>
    <form class="sb-search mb-3" action="<?= $searchUrl ?>" method="get">
        <label>
            <input value="<?= Yii::$app->request->get('query') ?>" name="query" type="text" placeholder="Поиск">
        </label>
    </form>
    <?php if (sizeof($models)): ?>
        <ul class="sb-cata-list">
            <?php foreach ($models as $model): ?>
                <li>
                    <a href="<?= Url::to([
                        '/main/news/index', 'category' => $model->name_canonical
                    ]) ?>">
                        <?= $model->name ?>
                        <span style="background-color: <?= $model->color ?>"><?= $model->counter->count ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>
            Разделы не опубликованы
        </p>
    <?php endif; ?>
</div>
