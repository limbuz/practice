<?php

use app\models\City;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $user app\models\User */

$_GET['test'] = $dataProvider->keys;
?>

<div class="feedback-create">

    <h1><em><?= $user->fio ?></em>'s feedbacks</h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_feedbacksView',
        'layout' => "{items}\n{pager}",
    ]) ?>

</div>
