<?php
use dosamigos\fileupload\FileUploadUI;

/* @var string $attribute */
/* @var string $accept */

?>

<?= FileUploadUI::widget([
    'model' => $model,
    'attribute' => $attribute,
    'url' => Yii::$app->params['cdn_upload_path'],
    'gallery' => false,
    'fieldOptions' => [
        'accept' => $accept
    ],
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

