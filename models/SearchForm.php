<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
class SearchForm extends Model
{
    public $url;
    public $text;
    public $file;
//    public $category_id;
//    public $filter_id;
//    public $size_id;

    public function rules()
    {
        return [
            //[['company_id'], 'required'],
//            [['ean', 'model_id', 'category_id', 'filter_id', 'size_id'], 'integer'],//
            [['url', 'text'], 'string'],//
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url'       => 'Адреса для аналізу тексту',
            'text'      => 'Поле для введення тексту',
            'file'      => 'Файл образу',
//            'notebook'      => 'Внутрішній номер',
//            'ean'           => 'Штрих код',
//            'model_id'      => 'Модель товару'
        ];
    }

}
