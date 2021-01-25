<?php

use app\forms\AuthForm;
use app\forms\RegistrationForm;
use yii\web\View;

/* @var $this View */
/* @var $authModel AuthForm */
/* @var $registrationModel RegistrationForm */

?>

<div class="nk-modal modal fade" id="auth-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span class="ion-android-close"></span>
                </button>

                <div class="nk-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#auth-tab" role="tab" data-toggle="tab">Авторизация</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#registration-tab" role="tab" data-toggle="tab">Регистрация</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="auth-tab">
                            <div class="nk-gap"></div>
                            <?= $this->render('include/_auth', ['model' => $authModel]) ?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade show" id="registration-tab">
                            <div class="nk-gap"></div>
                            <?= $this->render('include/_registration', ['model' => $registrationModel]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>