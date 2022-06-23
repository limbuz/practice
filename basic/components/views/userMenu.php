<li class="nav-item dropdown">
    <?php use app\models\Comment;
    use app\models\User;
    use yii\bootstrap4\Dropdown;
    use yii\helpers\Html;
        $comms = new Comment();?>
        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link"> <?php echo Yii::$app->user->identity->username ?> <b class="caret"></b></a>
        <?php if (User::isAdmin()) echo Dropdown::widget([
            'items' => [
                ['label' => 'Создать новую запись', 'url' => ['post/create']],
                ['label' => 'Управление записями', 'url' => ['post/admin']],
                ['label' => 'Одобрение комментариев', 'url' => ['comment/index']],
                ['label' => 'Выход', 'url' => ['site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
            ],
        ]);
        else echo Dropdown::widget([
            'items' => [
                ['label' => 'Создать новую запись', 'url' => ['post/create']],
                ['label' => 'Выход', 'url' => ['site/logout'], 'linkOptions' => ['data' => ['method' => 'post']]],
            ],
        ]); ?>
</li>