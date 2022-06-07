<?php

use app\models\Comment;
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

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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

        <?php if(count($model->comments) >= 1): ?>
                <?php echo '<h3>' . count($model->comments) . ' comment(s) <h3>';

                echo $this->context->renderPartial('_comments',
                    [ 'post'=>$model,
                        'comments'=>$model->comments,
                    ]); ?>
        <?php endif; ?>

        <h3>Оставить комментарий</h3>

        <?php if(Yii::$app->session->hasFlash('commentSubmitted')): ?>
            <div class="flash-success">
                <?php echo Yii::$app->session->getFlash('commentSubmitted'); ?>
            </div>
        <?php else: ?>
            <?php $comment = new Comment();
            echo $this->context->renderPartial('/comment/_form',array(
                'model'=> $comment,
            )); ?>
        <?php endif; ?>
    </div>

</div>
