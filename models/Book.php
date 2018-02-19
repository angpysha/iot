<?php
/**
 * Created by PhpStorm.
 * User: Compil
 * Date: 02.04.2017
 * Time: 20:08
 */
namespace app\models;
use Yii;

class Book extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'book';
    }

    public function rules()
    {
        return [
            [['title', 'author', 'publisher', 'year'], 'required'],
            [['id', 'year'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['author','publisher'], 'string', 'max' => 50]
        ];
    }
}