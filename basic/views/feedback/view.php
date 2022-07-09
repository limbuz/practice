<?php

use app\models\City;
use app\models\User;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="feedback-view">
        <div class="container">
            <div class="mx-auto col-md-10 rounded" style="box-shadow: 0 2px 4px rgba(0, 0, 0, .25); background: #FFFFFF">
                <h2 class="text-center"><?= $model->title ?> <?= $model->rating ?>/5</h2>
                <p class="text-center" style="background-color: white"><?= $model->text ?></p>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="#" id=<?= 'author' . $model->id ?>>
                        <h6 class="text-right" style="color: #000000"><?= $model->getAuthor()->one()['fio'] ?></h6>
                    </a>
                <?php else: ?>
                    <h6 class="text-right" style="color: #000000"><?= $model->getAuthor()->one()['fio'] ?></h6>
                <?php endif; ?>

                <h6 class="text-right" style="color: #000000"><?= date('d.m.Y' ,$model->date_create) ?></h6>

                <?php if (!Yii::$app->user->isGuest): ?>
                    <br>
                    <div class="dropdown text-right">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Действие
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary dropdown-item']) ?>
                            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger dropdown-item',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <br>
            </div>
        </div>

    <?php Modal::begin([
        'title' => $model->getAuthor()->one()['fio'],
        'id' => 'authorInfo' . $model->id
    ]) ?>

    <?= Html::label('E-mail', 'email') ?>
    <?= Html::input('email', 'email', $model->getAuthor()->one()['email'], ['class' => 'form-control', 'disabled' => true]) ?>
    <br>
    <?= Html::label('Phone', 'phone') ?>
    <?= Html::input('text', 'phone', $model->getAuthor()->one()['phone'], ['class' => 'form-control', 'disabled' => true]) ?>
    <br>
    <?= Html::a('View all feedbacks by this author', ['feedback/userFeedbacks'], ['class' => 'btn btn-primary']) ?>

    <?php Modal::end() ?>

    <?php $this->registerJs('$("#author' . $model->id . '").click(function() { $("#authorInfo' . $model->id .'").modal("show"); })') ?>

    <hr>

    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_city' => [
                'label' => 'city name',
                'value' => City::findOne(['id' => $model->id_city])->name
            ],
            'title',
            'text',
            'rating',
            'img',
            'id_author' => [
                'label' => 'Author name',
                'value' => \app\models\User::findOne(['id' => $model->id_author])->fio
            ],
            'date_create' => [
                'label' => 'Creation date',
                'value' => date('d/m/Y', $model->date_create)
            ],
        ],
    ]) ?-->

</div>
