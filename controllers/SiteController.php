<?php

namespace app\controllers;

use app\models\Smoke;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionHelp()
    {
        return $this->render('help');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSmoke($fume, $temp, $location)
    {
        $smoke = new Smoke();
        $smoke->fume = $fume;
        $smoke->temp = $temp;
        $smoke->location = $location;
        $smoke->save();
        return $this->render('smoke');
    }

    public function actionSmokeview()
    {
        $values = Smoke::find()->asArray()->all();
//        echo "<br/>";
//        echo "<br/>";
//        echo "<br/>";
        foreach ($values as $key=>$value ){
            $fume[$key] = intval($value["fume"]);
            $temp[$key] = intval($value["temp"]);
        }
//        var_dump($fume);
//        var_dump($temp);
        return $this->render('smokeview',[
            'fume' => $fume,
            'temp' => $temp,
        ]);
    }

//    public function actionJson()
//    {
//        $models = User::find()->all();
//
//        $data = array_map(function ($model) {return $model->attributes;}, $models);
//
//        $response = Yii::$app->response;
//        $response->format = Response::FORMAT_JSON;
//        $response->data = $data;
//        return $response;
//    }
}
