<?php

namespace app\components;

use app\models\Comment;
use app\models\Tag;
use phpDocumentor\Reflection\Types\This;
use yii\base\Widget;
use yii\helpers\Html;

class RecentComments extends Widget {
    public $title = 'Recent Comments';

    public function getRecentComments()
    {
        return Comment::findRecentComments(10);
    }

    public function run()
    {
        echo $this->render('recentComments');
    }
}
