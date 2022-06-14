<?php

namespace app\components;

use app\models\Tag;
use yii\base\Widget;
use yii\helpers\Html;

class TagCloud extends Widget
{
    public $title='Tags';
    public $maxTags=20;

    public function run()
    {
        $tag = new Tag();
        $tags= $tag->findTagWeights($this->maxTags);

        foreach($tags as $tag=>$weight)
        {
            $link=Html::a(Html::encode($tag), array('post/index','tag'=>$tag));
            echo Html::tag('span', array(
            'class'=>'tag',
            'style'=>"font-size:{$weight}pt",
            ), $link)."\n";
        }
    }
}