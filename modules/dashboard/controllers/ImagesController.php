<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Gallery;
use app\services\GalleryService;
use app\services\UsersService;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ImagesController extends DashboardController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        GalleryService $galleryService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $galleryService;
    }

    public function actionUpload()
    {
        $model = new Gallery();

        $imageFile = UploadedFile::getInstance($model, 'file');

        $directory = Yii::getAlias('@app/web/images') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = '/images/' . $fileName;

                $model->url = $path;
                $model->save();

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $imageFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => '/dashboard/images/delete?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    public function actionDelete($name)
    {
        $directory = Yii::getAlias('@app/web/images');
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = '/images/' . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    public function actionRemove($id)
    {
        $model = $this->service->findOne($id);

        $directory = Yii::getAlias('@app/web');
        if (is_file($directory . DIRECTORY_SEPARATOR . $model->url)) {
            unlink($directory . DIRECTORY_SEPARATOR . $model->url);
        }
        $model->delete();

        return $this->redirect(['index']);
    }
}
