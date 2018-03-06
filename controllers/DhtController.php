<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 05.03.2018
 * Time: 22:58
 */

namespace app\controllers;
use yii\web\Controller;
use yii\filters\AccessControl;

class DhtController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup','index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup','index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {

    }


    public function actionIndex() {
        var_dump("fas");
    }
}

