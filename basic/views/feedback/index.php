<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Feedback */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $model['name'];
?>


<?php if (Yii::$app->session->has('city')): ?>

<div class="feedback-index">

    <h1><?= Yii::$app->session->get('city') ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Написать отзыв', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'view',
            'layout' => "{items}\n{pager}",
    ]) ?>

</div>

<?php endif; ?>
