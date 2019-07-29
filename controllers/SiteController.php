<?php

namespace app\controllers;

use app\models\Answers;
use app\models\QuestionsInput;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use yii\data\Pagination;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'ask';
        $questions = new QuestionsInput();
        $answers = new Answers();
        $q=Answers::find()->orderBy('id DESC');
        $countQuery = clone $q;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 8]);
        $models = $q->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        if (Yii::$app->request->isPost){
            if ($questions->load(Yii::$app->request->post()) && $questions->validate()){
                $questions->date  = date("Y-m-d");
                $questions->ip = Yii::$app->request->remoteIP;
                $questions->save();
                Yii::$app->session->addFlash('success','Ваш вопрос зарегистрирован. Посетите эту страницу через некоторое время, чтобы увидеть ответ.');
            }
        }
        return $this->render('index', ['questions'=>$questions, 'answers'=>$answers, 'models'=>$models, 'pages' => $pages]);
    }

    /**
     * Redirect to main website
     *
     * @return Response
     */
    public function actionSaldim(){
        return $this->redirect('http://saldim.ru','302');
    }




    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionPrivacy(){
        return $this->render('privacy');
    }
}
