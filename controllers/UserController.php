<?php
/**
 * Created by PhpStorm.
 * User: Compil
 * Date: 28.04.2016
 * Time: 23:46
 */
namespace app\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';
}