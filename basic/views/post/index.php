<?php

use app\models\Lookup;
use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest) {
        echo Html::a('Create Post', ['create'], ['class' => 'btn btn-success']);
    }?>

    <?php if(!empty($_GET['tag'])): ?>
        <h1>Записи с тегом <em><?php echo Html::encode($_GET['tag']); ?></em></h1>
    <?php endif; ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'view',
        'layout' => "{items}\n{pager}",
    ]); ?>


</div>
