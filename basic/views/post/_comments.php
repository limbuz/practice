<?php use app\models\Post;
use yii\helpers\Html;

/* @var $post
 * @var $comments */

foreach($comments as $comment): ?>
    <div class="comment" id="c<?php echo $comment->id; ?>">

        <?php echo Html::a("#{$comment->id}", $comment->getUrl(), array(
            'class'=>'cid',
            'title'=>'Permalink to this comment',
        )); ?>

        <div class="author">
            <?php echo $comment->author; ?> says:
        </div>

        <div class="time">
            <?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?>
        </div>

        <div class="content">
            <?php echo nl2br(Html::encode($comment->content)); ?>
        </div>

    </div><!-- comment -->
<?php endforeach; ?>