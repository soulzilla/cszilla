<?php
/** @var $models app\models\PredictionCounter[] */
?>

<?php if (sizeof($models)): ?>
    <div class="nk-gap-2"></div>

    <table class="nk-table">
        <thead>
        <tr>
            <th colspan="3">Лучшие прогнозисты</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="w-50">Ник</td>
            <td class="w-25">Прогнозы</td>
            <td class="w-25">Винрейт</td>
        </tr>
        <?php foreach ($models as $model): ?>
            <tr>
                <td class="w-50"><?= $model->user->name ?></td>
                <td class="w-25"><?= $model->predictions ?>/<span class="text-success"><?= $model->success_predictions ?></span></td>
                <td class="w-25"><?= $model->win_rate ?>%</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
