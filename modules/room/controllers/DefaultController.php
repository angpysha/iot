<?php

namespace app\modules\room\controllers;

use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use dektrium\user\models\Profile;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $db = new yii\db\Connection(Yii::$app->db);
        $id = Yii::$app->user->getId();
        $roles = Yii::$app->authManager->getRolesByUser($id);

        $profile = $db->createCommand('SELECT * FROM profile WHERE user_id=:userid')
            ->bindValue(':userid', $id)
            ->queryOne();


        return $this->render('index',[
            'roles' => $roles,
            'profile' => $profile,
        ]);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => true, 'actions' => ['index'], 'roles' => ['@']],
                    //['allow' => true, 'actions' => ['show'], 'roles' => ['?', '@']],
                ]
            ],
        ];
    }
}
