<?php

use app\models\City;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <?php $session = Yii::$app->session;
    $session->timeout = 2* 3600;?>

    <?php $ip = '78.31.5.226'; //$_SERVER['REMOTE_ADDR'] not fot localhost
    $request = file_get_contents('http://ipwho.is/' . $ip . '?lang=ru');
    $request = json_decode($request, true);
    $city = $request['city']; ?>

    <?php if ($city !== false): ?>

        <?php Modal::begin([
                'options' => [
                    'id' => 'cityModal',
                    'style' => 'font-size: 20px; text-align: center'
                ],
                'size' => Modal::SIZE_SMALL
        ]); ?>

        <?= '<p>Ваш город: ' . $city . ' <img src=' . $request['flag']['img'] .' width="15" height="10" alt="">?</p>'; ?>

        <?= HTML::a("Да", ['feedback/index', 'city' => $city], ['class' => 'btn btn-primary', 'style' => 'margin-right: 5px', 'id' => 'yes']); ?>

        <?= HTML::button("Нет", ['class' => 'btn btn-primary', 'id' => 'no']); ?>

        <?php Modal::end(); ?>

        <?php if (!$session->has('city')): ?>

            <?php $this->registerJs("$('#cityModal').modal('show');
               $('#yes').click(() => { $('#cityModal').modal('hide'); });
               $('#no').click(() => { $('#cityModal').modal('hide'); })
            ") ?>

        <?php endif; ?>

    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model) {
            return Html::a(Html::encode($model->name), ['feedback/index', 'city' => $model->name]);
        },
    ]) ?>


</div>
