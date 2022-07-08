<?php

use app\models\City;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\models\Feedback */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if (Yii::$app->session->has('city')): ?>

<div class="feedback-index">

    <h1><?= Yii::$app->session->get('city') ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>

    <!--?php echo $this->render('_search', ['model' => $searchModel]); ?-->


    <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'view',
            'layout' => "{items}\n{pager}",
    ]) ?>

</div>

<?php endif;
