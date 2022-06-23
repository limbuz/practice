<?php

use app\models\Comment;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (!Yii::$app->user->isGuest)
        if (User::isAdmin() || Yii::$app->user->identity->id === $model->author_id)
            echo '<p>' .
                Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) . ' ' .
                Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) .
                '</p>';
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            'tags',
            'status',
            'create_time',
            'update_time',
            'author_id',
        ],
    ]) ?>

    <div id="comments">
        <?php $comments = 0;
            foreach ($model->comments as $comment) {
                if ($comment->status == Comment::STATUS_APPROVED)
                    $comments++;
            } ?>
        <?php if($comments > 0): ?>
                <?php echo '<h3>' . $comments . ' comment(s) <h3>';

                echo $this->context->renderPartial('_comments',
                    [ 'post'=>$model,
                      'comments'=>$model->comments,
                    ]); ?>
        <?php endif; ?>

        <?php if(!Yii::$app->user->isGuest)
            echo '<h3>Оставить комментарий</h3>' .
            $this->context->renderPartial('/comment/_form',[
                'model' => new Comment(),
                'post' => $model,
            ]); ?>
    </div>

</div>
