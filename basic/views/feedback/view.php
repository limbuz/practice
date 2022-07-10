<?php

use app\models\User;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php $author = $model->getAuthor()->one() ?>

<div class="feedback-view">
        <div class="container">
            <div class="mx-auto col-md-10 rounded" style="box-shadow: 0 2px 4px rgba(0, 0, 0, .25); background: #FFFFFF">
                <h2 class="text-center"><?= $model->title ?> <?= $model->rating ?>/5</h2>
                <p class="text-center" style="background-color: white"><?= $model->text ?></p>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="#" id=<?= 'author' . $model->id ?>>
                        <h6 class="text-right" style="color: #000000"><?= $author['fio'] ?></h6>
                    </a>
                <?php else: ?>
                    <h6 class="text-right" style="color: #000000"><?= $author['fio'] ?></h6>
                <?php endif; ?>

                <h6 class="text-right" style="color: #000000"><?= date('d.m.Y' ,$model->date_create) ?></h6>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <?php if (User::isAdmin() || Yii::$app->user->id === $model->id_author): ?>
                    <br>
                    <div class="dropdown text-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Действие
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if (Yii::$app->user->id === $model->id_author):?>
                                <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary dropdown-item']) ?>
                            <?php endif; ?>
                            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger dropdown-item',
                                'data' => [
                                    'confirm' => 'Вы точно хотите удалить этот отзыв?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>

                <br>
            </div>
        </div>

    <?php Modal::begin([
        'title' => $author['fio'],
        'id' => 'authorInfo' . $model->id
    ]) ?>

    <?= Html::label('E-mail', 'email') ?>
    <?= Html::input('email', 'email', $author['email'], ['class' => 'form-control', 'disabled' => true]) ?>
    <br>
    <?= Html::label('Телефон', 'phone') ?>
    <?= Html::input('text', 'phone', $author['phone'], ['class' => 'form-control', 'disabled' => true]) ?>
    <br>
    <?= Html::a('Посмотреть все отзывы автора', ['feedback/user', 'id' => $author['id']], ['class' => 'btn btn-primary']) ?>

    <?php Modal::end() ?>

    <?php $this->registerJs('$("#author' . $model->id . '").click(function() { $("#authorInfo' . $model->id .'").modal("show"); })') ?>

    <hr>
</div>
