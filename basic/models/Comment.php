<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property int $id
 * @property string|null $content
 * @property int|null $status
 * @property string|null $create_time
 * @property string|null $author
 * @property string|null $email
 * @property string|null $url
 * @property int|null $post_id
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    const STATUS_PENDING=1;
    const STATUS_APPROVED=2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    public static function findRecentComments($limit=10)
    {
        return Comment::find()->where(['status' => 2])->
                                limit($limit)->
                                orderBy('create_time DESC')->
                                with('post')->all();
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['status', 'url', 'content'], 'required'],
            [['id', 'status', 'post_id'], 'integer'],
            [['create_time'], 'safe'],
            [['author', 'email', 'url'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'author' => 'Name',
            'email' => 'Email',
            'url' => 'Website',
            'post_id' => 'Post',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function approve()
    {
        $this->status=Comment::STATUS_APPROVED;
        $this->update(true, ['status']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert) {
                $this->create_time = time();
                $this->author = Yii::$app->user->identity->username;
                $this->email = User::findOne(['id'=>Yii::$app->user->id])->email;
                if (!User::isAdmin()) {
                    $this->status = self::STATUS_PENDING;
                }
            }
            return true;
        }
        else
            return false;
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['comment/view', 'id'=>$this->id]);
    }

    public function getPendingCommentCount()
    {
        return count(Comment::findAll(['status' => self::STATUS_PENDING]));
    }
}
