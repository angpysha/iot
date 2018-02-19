<?php
/**
 * Created by PhpStorm.
 * User: Compil
 * Date: 02.04.2017
 * Time: 20:35
 */
namespace app\controllers;

use yii\rest\ActiveController;

class FilmController extends ActiveController
{
    // указываем класс модели, который будет использоваться
    public $modelClass = 'app\models\Film';

    public function behaviors()
    {
        return
            \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => \yii\filters\Cors::className(),
                ],
            ]);
    }
}