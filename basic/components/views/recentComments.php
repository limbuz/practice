<ul>
	<?php use app\components\RecentComments;
    use app\models\Comment;
    use yii\helpers\Html;

    foreach(Comment::findRecentComments() as $comment): ?>
	<li><?php echo $comment->author; ?> on
		<?php echo Html::a(Html::encode($comment->post->title), $comment->getUrl()); ?>
	</li>
	<?php endforeach; ?>
</ul>