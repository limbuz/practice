<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <?php
        $ip = '78.31.5.226'; //$_SERVER['REMOTE_ADDR'] not fot localhost
        $request = file_get_contents('http://ipwho.is/' . $ip);
        $request = json_decode($request, true);
        $city = $request['city'];
    if ($city !== false): ?>
        <p>Ваш город: <?= $city ?> <img src="<?= $request['flag']['img'] ?>" width="15" height="10" alt="">? Yes/No</p>
    <?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create City', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
        },
    ]) ?>


</div>
