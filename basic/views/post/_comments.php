<?php use app\models\Comment;
use app\models\Post;
use yii\helpers\Html;

/* @var $post app\models\Post*/
/* @var $comments app\models\Comment[] */

foreach($comments as $comment):
    if ($comment->status !== Comment::STATUS_PENDING) echo
    '<div class="comment" id="c' . $comment->id . '">' .

        Html::a("#{$comment->id}", $comment->getUrl(), array(
            'class'=>'cid',
            'title'=>'Permalink to this comment',
        )) .

        '<div class="author">' .
            $comment->author . ' says:
        </div>

        <div class="time">' .
            date('F j, Y \a\t h:i a',$comment->create_time) .
        '</div>

        <div class="content">' .
            nl2br(Html::encode($comment->content)) .
        '</div>

    </div>';
endforeach; ?>