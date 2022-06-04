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
 * @property int|null $status
 * @property int|null $create_time
 * @property int|null $update_time
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

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->create_time = date('Y-m-d');
            $this->update_time = date('Y-m-d');
            $this->author_id = Yii::$app->user->id;
        } else {
            $this->update_time = date('Y-m-d');
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        (new Tag)->updateFrequency($this->_oldTags, $this->tags);
    }

    private $_oldTags;

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }

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
            [['id', 'author_id'], 'integer'],
            [['title', 'content', 'tags', 'status', 'create_time', 'update_time'], 'string', 'max' => 45],
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
