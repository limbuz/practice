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
            [['id'], 'required'],
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
        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }

    public function updateFrequency($oldTags, $newTags)
    {
        $oldTags=self::string2array($oldTags);
        $newTags=self::string2array($newTags);
        $this->addTags(array_values(array_diff($newTags,$oldTags)));
        $this->removeTags(array_values(array_diff($oldTags,$newTags)));
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
                $tag->save();
            }
            else {
                $result->updateCounters(['frequency' => ($result->frequency + 1)]);
            }
        }
    }

    public static function removeTags($tags)
    {
        if(empty($tags))
            return;

        foreach($tags as $name) {
            $tag = Tag::findOne(['name' => $name]);
            $tag->updateCounters(['frequency' => ($tag->frequency - 1)]);
        }

        Tag::deleteAll('frequency <= 0');
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
