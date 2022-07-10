<?php

namespace app\controllers;

use app\models\City;
use app\models\Feedback;
use app\models\FeedbackSearch;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
     * Lists all Feedback models.
     *
     * @return \yii\web\Response|string
     */
    public function actionIndex($city = null)
    {
        $session = Yii::$app->session;
        $searchModel = new FeedbackSearch();

        if ($city === null) {
            return $this->redirect(['city/index']);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => City::findOne(['name' => $city])->getFeedbacks(),
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
            $session->set('city', $city);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedback model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Feedback();
        $city = new City();
        $cities = [];

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $city->load($this->request->post())) {
                if (empty($city->name)) {
                    $data = City::find()->asArray()->all();

                    for ($i = 0; $i < count($data); $i++) {
                        $cities[$i] = $data[$i]['name'];
                    }
                } else {
                    $cities = preg_split("/[\s,]+/", trim($city->name . ','), -1, PREG_SPLIT_NO_EMPTY);
                    $this->checkData($cities);
                }
                $this->saveData($cities);

                return $this->redirect(['index', 'city' => Yii::$app->session->get('city')]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $this->prepareData(),
            'city' => $city
        ]);
    }

    public function saveData($cities)
    {
        foreach ($cities as $city) {
            $model = new Feedback();
            $model->load($this->request->post());
            $model->rating++;
            $model->id_city = City::findOne(['name' => $city])->id;
            $model->save(false);
        }
    }

    public function prepareData(): string
    {
        $expression = '';
        $data = City::find()->all();

        /** @var City $city */
        foreach ($data as $city) {
            $expression .= '"' . $city->name . '", ';
        }

        return '[' . $expression . ']';
    }

    public function checkData($cities)
    {
        foreach ($cities as $city) {
            $cityId = City::findOne(['name' => $city]);

            if ($cityId === null) {

                $USERAGENT = $_SERVER['HTTP_USER_AGENT'];
                $opts = array('http'=>array('header'=>"User-Agent: $USERAGENT\r\n"));
                $context = stream_context_create($opts);
                $request = file_get_contents('https://nominatim.openstreetmap.org/search?city=' . $city . '&format=json', false, $context);
                $request = json_decode($request, true);

                for ($i = 0; $i < 2; $i++) {
                    $name = preg_split('/[\s,]+/', $request[$i]['display_name']);

                    if ($city === $name[0]) {
                        $instance = new City();
                        $instance->name = $city;
                        $instance->date_create = time();
                        $instance->save(false);
                    }
                }
            }
        }
    }

    public function actionUser($id): string
    {
        $user = User::findOne(['id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $user->getFeedbacks(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('_feedbacks', [
            'dataProvider' => $dataProvider,
            'user' => $user,
            'model' => new Feedback()
        ]);
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'city' => City::findOne(['id' => $model->id_city]),
            'data' => $this->prepareData()
        ]);
    }

    /**
     * Deletes an existing Feedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
