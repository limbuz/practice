<?php

use app\models\City;
use yii\widgets\DetailView;

/* @var $model app\models\Feedback */

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id_city' => [
            'label' => 'Название города',
            'value' => City::findOne(['id' => $model->id_city])->name
        ],
        'title',
        'text',
        'rating',
        'id_author' => [
            'label' => 'Имя Автора',
            'value' => \app\models\User::findOne(['id' => $model->id_author])->fio
        ],
        'date_create' => [
            'label' => 'Дата создания',
            'value' => date('d/m/Y', $model->date_create)
        ],
    ],
]);

echo '<hr>';