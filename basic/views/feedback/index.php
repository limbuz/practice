<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php if (Yii::$app->session->has('city')): ?>

<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--?php echo $this->render('_search', ['model' => $searchModel]); ?-->

    <?= DetailView::widget([

    ]) ?>

</div>

<?php endif;
