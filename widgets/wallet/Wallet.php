<?php

namespace app\widgets\wallet;

use app\models\WalletTask;
use Yii;
use yii\bootstrap4\Widget;

class Wallet extends Widget
{
    public function run()
    {
        $wallet = Yii::$app->user->identity->wallet;

        if (!$wallet) {
            $wallet = new \app\models\Wallet();
            $wallet->user_id = Yii::$app->user->id;
            $wallet->coins = 10;
            $wallet->save();
        }

        $tasks = WalletTask::find()->orderBy(['id' => SORT_DESC])->with(['status'])->limit(10)->all();

        return $this->render('index', [
            'wallet' => $wallet,
            'tasks' => $tasks
        ]);
    }
}
