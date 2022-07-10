<?php

use app\models\User;
use yii\helpers\Html;

/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'token' => $user->token]);
?>
    <div class="confirmation">
    <p>Здравствуйте, <?= Html::encode($user->fio) ?>.</p>

    <p>Перейдите по ссылке ниже для подтверждения регистрации:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
    </div>
