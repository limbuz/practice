<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_feedback".
 *
 * @property int $id
 * @property int $id_city
 * @property string $title
 * @property string $text
 * @property int $rating
 * @property string|null $img
 * @property int $id_author
 * @property string $date_create
 *
 * @property User $author
 * @property City $city
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'rating', 'id_author', 'date_create'], 'required'],
            [['rating', 'id_author'], 'integer'],
            [['img'], 'string'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['text'], 'string', 'max' => 255],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_author' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Название города',
            'title' => 'Заголовок',
            'text' => 'Содержание',
            'rating' => 'Рейтинг',
            'img' => 'Картинка',
            'id_author' => 'ID автора',
            'date_create' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_author']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert) {
                $this->date_create = time();
                $this->id_author = Yii::$app->user->identity->id;
            }
            return true;
        }
        else {
            return false;
        }
    }
}
