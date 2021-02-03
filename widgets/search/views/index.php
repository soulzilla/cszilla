<?php

/** @var $query string */

use app\components\helpers\Url;

?>

<div class="nk-modal modal fade" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Закрыть">
                    <span class="ion-android-close"></span>
                </button>

                <h4 class="mb-0">Поиск</h4>

                <div class="nk-gap-1"></div>
                <form action="<?= Url::to(['/main/news/index']) ?>" class="nk-form nk-form-style-1">
                    <input type="text"
                           value="<?= $query ?>"
                           name="query"
                           class="form-control"
                           placeholder="Введите фразу для поиска и нажмите Enter" autofocus>
                </form>
            </div>
        </div>
    </div>
</div>
