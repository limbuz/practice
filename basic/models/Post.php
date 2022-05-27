<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $content
 * @property string|null $tags
 * @property string|null $status
 * @property string|null $create_time
 * @property string|null $update_time
 * @property int|null $author_id
 *
 * @property User $author
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'author_id'], 'integer'],
            [['title', 'content', 'tags', 'status', 'create_time', 'update_time'], 'string', 'max' => 45],
            ['title, content, status', 'required'],
            ['status', 'in', 'range'=>array(1,2,3)],
            ['tags', 'match', 'pattern'=>'/^[\w\s,]+$/',
                'message'=>'В тегах можно использовать только буквы.'],
            ['tags', 'normalizeTags'],
            ['title, status', 'safe', 'on'=>'search'],
            [['id'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * tag normalize
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'tags' => 'Tags',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    public function getUrl()
    {
        Yii::$app->urlManager->createUrl(['post/view', 'id'=>$this->id, 'title'=>$this->title]);
    }
}
