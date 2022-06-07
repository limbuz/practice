<?php

use yii\base\Widget;
use yii\helpers\Html;

class UserMenu extends Widget
{
    public function init()
    {
        $this->title=Html::encode(Yii::$app->user->name);
        parent::init();
    }

    protected function renderContent()
    {
        return $this->render('userMenu');
    }
}