<?php

/** @var $provider yii\data\DataProviderInterface */

/** @var $models Gallery[] */

use app\components\helpers\Url;
use app\models\Gallery;
use dosamigos\fileupload\FileUploadUI;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Картинки';
$models = $provider->getModels();

$gallery = new Gallery();
?>

<div class="gallery">

    <?= FileUploadUI::widget([
        'model' => $gallery,
        'attribute' => 'file',
        'url' => '/dashboard/images/upload',
        'gallery' => false,
        'clientOptions' => [
            'maxFileSize' => 1024*1024*100
        ],
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                            }',
            'fileuploadfail' => 'function(e, data) {
                            }',
        ],
    ]); ?>

    <?php if (sizeof($models)): ?>
        <?php foreach ($models as $model): ?>
            <div style="border: solid 1px #2b81af; margin-bottom: 1rem;">
                <?= Html::img($model->url) ?>

                <p>
                    <?= $model->url ?>
                </p>

                <p>
                    <a href="<?= Url::to(['remove', 'id' => $model->id]) ?>">Удалить</a>
                </p>
            </div>
        <?php endforeach; ?>

        <?= LinkPager::widget([
            'pagination' => $provider->getPagination()
        ]) ?>
    <?php endif; ?>

</div>
