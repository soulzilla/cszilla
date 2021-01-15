<?php

use app\components\core\ActiveRecord;
use app\models\Gallery;
use dosamigos\fileupload\FileUploadUI;
use yii\helpers\Html;

/* @var string $attribute */
/* @var ActiveRecord $model */
/* @var Gallery $gallery */

$inputName = $model->formName() . '[' . $attribute . ']';

$successCallback = 'function(e, data){
    $(\'#' . $model->formName() . '-' . $attribute . '\').val(data.result.files[0].url)' .
'}';
?>

<?php if ($model->getAttribute($attribute)): ?>
    <?= Html::img($model->getAttribute($attribute)) ?>
<?php endif; ?>

<?= Html::hiddenInput($inputName, $model->getAttribute($attribute), [
    'id' => $model->formName() . '-' . $attribute
]) ?>

<?= FileUploadUI::widget([
    'model' => $gallery,
    'attribute' => 'file',
    'url' => '/dashboard/images/upload',
    'gallery' => false,
    'fieldOptions' => [
        'multiple' => false
    ],
    'clientOptions' => [
        'maxFileSize' => 1024*1024*100
    ],
    'clientEvents' => [
        'fileuploaddone' => $successCallback,
        'fileuploadfail' => 'function(e, data) {
                            }',
    ],
]); ?>

