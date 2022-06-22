<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tag".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'frequency'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function string2array($tags)
    {
        return preg_split('/\s*, \s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }

    public static function addTags($tags)
    {
        $array = self::string2array($tags);

        foreach($array as $name)
        {
            $result = Tag::findOne(['name' => $name]);
            if ($result === null)
            {
                $tag = new Tag();
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save(false);
            }
            else {
                $result->updateCounters(['frequency' => 1]);
            }
        }
    }

    public static function removeTags($tags)
    {
        $array = self::string2array($tags);

        if(empty($array))
            return;

        foreach ($array as $name) {
            $tag = Tag::findOne(['name' => $name]);
            $tag->updateCounters(['frequency' => -1]);
        }

        Tag::deleteAll('frequency = 0');
    }

    public function findTagWeights($limit=20)
    {
        $models=Tag::find()->orderBy('frequency DESC')->limit($limit)->all();

        $total = 0;
        foreach($models as $model)
            $total += $model->frequency;

        $tags = array();
        if($total > 0)
        {
            foreach($models as $model)
                $tags[$model->name] = 8 + (int)(16 * $model->frequency / ($total + 10));
            ksort($tags);
        }
        return $tags;
    }
}
