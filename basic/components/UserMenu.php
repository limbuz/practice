<?php
namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class UserMenu extends Widget
{
    public function init()
    {
        $this->id=Html::encode(Yii::$app->user->identity->username);
        parent::init();
    }

    public function run()
    {
        echo $this->render('userMenu');
    }
}