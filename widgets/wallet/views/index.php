<?php

/** @var $wallet app\models\Wallet */
/** @var $tasks app\models\WalletTask[] */
?>

<?php if (!Yii::$app->user->isGuest): ?>
    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Ваши</span> задания</span></h4>
        <div class="nk-widget-content py-0">
            <?php if (sizeof($tasks)): ?>
                <?php foreach ($tasks as $task): ?>
                    <div class="nk-widget-match p-10 my-1 <?= $task->status ? '' : 'pulse' ?>" id="task-<?= $task->id ?>">
                        <a class="confirm-task" href="<?= $task->url ?>" target="_blank" data-id="<?= $task->id ?>">

                            <span class="nk-widget-match-left"><?= $task->content ?></span>
                            <span class="nk-widget-match-right ml-auto">
                                <span class="nk-match-score <?= $task->status ? 'bg-secondary' : 'bg-success' ?>"
                                      id="task-cost-<?= $task->id ?>">
                                    <?= $task->status ? '&#10003;' : $task->cost ?>
                                </span>
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="nk-widget-match p-10 my-1">
                    <span>Заданий пока нет.</span>
                </div>
            <?php endif; ?>
            <div class="nk-widget-match p-10 my-0">
                <div>
                    <span class="nk-widget-match-left">Ваш баланс</span>
                    <span class="nk-widget-match-right ml-auto">
                        <span class="balance nk-match-score"><?= $wallet->coins ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>