<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use app\models\PostSearch;
use app\models\Tag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessRule;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Post models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $criteria = Post::find()->where(
            ['status' => Post::STATUS_PUBLISHED
            ])->orderBy('update_time DESC');
        if(isset($_GET['tag']))
            $criteria = Post::find()->where([
                'tags' => $_GET['tag'],
                'status' => Post::STATUS_PUBLISHED
            ])->orderBy('update_time DESC');

        $dataProvider=new ActiveDataProvider([
            'query'=>$criteria,
            'pagination'=>[
                'pageSize'=>5,
            ]
        ]);

        return $this->render('index',[
            'searchModel' => new PostSearch(),
            'dataProvider'=>$dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $post = $this->loadModel();

        return $this->render('view', [
            'model' => $post,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id, '');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Comment::deleteAll(['post_id' => $id]);
        $this->findModel($id,'')->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $condition)
    {
        if (($model = Post::findOne(['id' => $id, $condition])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private $_model;

    private function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
            {
                if(Yii::$app->user->isGuest)
                    $condition='status='.Post::STATUS_PUBLISHED
                        .' OR status='.Post::STATUS_ARCHIVED;
                else
                    $condition='';
                $this->_model=Post::findOne(['id' => $_GET['id'], $condition]);
            }
            if($this->_model===null)
                throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
        return $this->_model;
    }
}
