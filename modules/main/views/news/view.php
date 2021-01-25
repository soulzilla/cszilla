<?php
/* @var $model Publication */
/* @var $this yii\web\View */

use app\components\helpers\{StringHelper, Url};
use app\models\Publication;
use app\widgets\{categories\Categories,
    hot\Related,
    like\Like,
    comments\EntityComments};

$this->title = $model->title . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model])
?>

<section class="blog-list-section py-3">
    <div class="container">
        <div class="row px-3 px-lg-0">
            <div class="col-lg-8 bordered-box position-relative">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="blog-post single-post text-break">
                    <h3><?= $model->title ?></h3>
                    <div class="date-text" title="<?= StringHelper::humanize($model->publish_date, true) ?>">
                        <?= StringHelper::humanize($model->publish_date) ?>
                    </div>
                    <div class="post-metas">
                        <div class="post-meta">
                            <?= $model->category->name ?>
                        </div>
                        <div class="post-meta"><?= $model->author->name ?></div>
                    </div>
                    <?= $model->body ?>
                </div>
                <?= Like::widget(['entity' => $model]) ?>
            </div>
            <div class="col-lg-4 sidebar px-0 px-lg-3 pt-3 pt-lg-0">
                <?= Categories::widget() ?>

                <?= Related::widget([
                    'currentPublication' => $model
                ]) ?>
            </div>
        </div>
    </div>
</section>

<?= EntityComments::widget([
    'entity' => $model
]) ?>
