<?php

namespace app\modules\room\controllers;

use app\models\Category;
use app\models\FilterGroup;
use app\models\Filter;
use app\models\Location;
use app\models\ModelLong;
use app\models\ModelToCategory;
use app\models\ModelToFilter;
use app\models\ModelToImage;
use app\models\Product;
use app\models\ProductAction;
use app\models\ProductStatus;
use app\models\Size;
use Yii;
use yii\validators;
use app\models\ProductModel;
use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use yii\web\Response;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;



use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StatisticsController extends \yii\web\Controller
{

    /*
     * Формування електронноъ таблиці Exel
     *
     * */
    public function actionExel($id)
    {
        if(Yii::$app->user->can('rediscount')) {
            $prarr = [];
            $allpr = Product::find()->joinWith(['model'])->joinWith(['category'])->where(['status_id'=> [1,3], 'location_id'=>$id])->asArray()->all();//Only available

            foreach ($allpr as $key=>$item){
                //get another values
                $cats = "";
                $ml = ModelLong::findOne((int)$item["model"]["long_id"]);
                $size = Size::findOne((int)$item["size_id"]);
                foreach ($item ["category"] as $num=>$cat){
                    $cats .= $cat["category_name"].' ';
                }
//                var_dump($ml);
                // array construct
                $prarr[$key]["key"] = $key+1;//
                $prarr[$key]["product_id"] = $item["product_id"];
                $prarr[$key]["notebook"] = $item["notebook"];
                $prarr[$key]["model_id"] = 'G'.$item ["model_id"];
                $prarr[$key]["ean"] = $item["ean"];

                $prarr[$key]["model_name"] = $item["model"]["model_name"];
                $prarr[$key]["size_ua"] = $size ["UKR"];
                $prarr[$key]["size_int"] = $size ["INT"];
                $prarr[$key]["long"] = $ml ["long_name"];
                $prarr[$key]["size_furs"] = $size ["furs"];
                $prarr[$key]["price"] = $item ["price"];
                $prarr[$key]["category"] = $cats;
            }

            $file = \Yii::createObject([
                'class' => 'codemix\excelexport\ExcelFile',

                'writer' => '\PHPExcel_Writer_Excel5', // Override default of `\PHPExcel_Writer_Excel2007`

                'sheets' => [
                    'У наявності' => [
                        // Data for this sheet not present in gate Db ...
                        //'class' => 'codemix\excelexport\ActiveExcelSheet',
                        //'query' => Filter::find(),//->where(['flags' => false])

                        'data' => $prarr,

                        // Set to `false` to suppress the title row
                        'titles' => [
                            '№',
                            'Код продукту',
                            'Код у зошиті',
                            'Код моделі',
                            'Штрих-код',

                            'Назва моделі',
                            'Розмір УКР',
                            'Розмір ІНТ',
                            'Довжина(см)',
                            'Обхват грудей',
                            'Ціна',
                            'Категорія',
                        ],
                    ],
                ],

            ]);
            $file->send('exel.xls');

        }
        else
            throw new ForbiddenHttpException;
    }



    /*
     *
     *
     *
     * */

    public function actionIndex()
    {
        if(Yii::$app->user->can('rediscount')) {
            return $this->render('index');
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     * Overall stat of location distribution of products and sells
     *
     * */

    public function actionCommonplace()
    {
        if(Yii::$app->user->can('statistics')) {

            $pr = Product::find()
                ->select(['location_id, COUNT(*) AS cnt'])
                ->where(['status_id' => [1,3]])//У наявності + відкладено
                ->groupBy('location_id')
                ->asArray()->all();
//            echo "<br/><br/><br/>";

            $pract = ProductAction::find()
                ->select(['location_id, COUNT(*) AS cnt'])
                ->where(['status_id' => [2,4]])//продано і у кредит
                ->groupBy('location_id')
                ->asArray()->all();
//            var_dump($pr);
//            die();
            return $this->render('commonplace',[
                'pr' => $pr,
                'pract' => $pract,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     * Overall stat of products by category
     *
     * */

    public function actionCommoncategory()
    {
        if(Yii::$app->user->can('statistics')) {
            $cat = [];

            $pc = ModelToCategory::find()
                ->select(['category_id','COUNT(*) AS cnt'])
                ->groupBy('category_id')
                ->asArray()->all();

//          find count of product of each model which is available and sale
            foreach($pc as $pey=>$c){
                unset($pmarr);
                $mod = ModelToCategory::find()->select(['productmodel_id'])->where(['category_id' => $c["category_id"]])->asArray()->all();

                foreach ($mod as $mey=>$ms)
                    $pmarr[$mey] = $ms["productmodel_id"];

                $pa = Product::find()
//                    ->select(['model_id','COUNT(*) AS cnt'])
                    ->where(['model_id' => $pmarr, 'status_id'=> [1,3]])//available
//                    ->groupBy('model_id')
                    ->asArray()->all();

                $ps = Product::find()
                    ->where(['model_id' => $pmarr, 'status_id'=> [2,4]])//available
                    ->asArray()->all();

                $cat[$c['category_id']]['available'] = count($pa);
                $cat[$c['category_id']]['sale'] = count($ps);

            }
//
//            die();
            return $this->render('commoncategory',[
                'pc' => $pc,
                'cat' => $cat,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
 * Overall stat of products by category
 *
 * */

    public function actionCommonsizes()
    {
        if(Yii::$app->user->can('statistics')) {
            $cat = [];

            $sz = Size::find()
                ->select(['size_id','together','sex'])
//                ->groupBy('category_id')
                ->asArray()->all();
//            var_dump($sz);

//          find count of product of each model which is available and sale
            foreach($sz as $sey=>$s){
                $pa = Product::find()
                    ->select(['size_id','COUNT(*) AS cnt'])
                    ->where(['size_id'=> $s['size_id'],'status_id'=> [1,3]])//available
                    ->groupBy('size_id')
                    ->asArray()->all();
                $pa = $pa + array(null);//Undefined offset: 0 error
//                print_r($pa[0]); //
//                echo "<br/>";


                $ps = Product::find()
                    ->select(['size_id','COUNT(*) AS cnt'])
                    ->where(['size_id'=> $s['size_id'],'status_id'=> [2,4]])//available
                    ->groupBy('size_id')
                    ->asArray()->all();
                $ps = $ps + array(null);//Undefined offset: 0 error
//                var_dump($ps);
//                echo "<br/>";

                $size[$s['size_id']]['available'] = $pa[0]['cnt'];
                $size[$s['size_id']]['sale'] = $ps[0]['cnt'];

            }

//            var_dump($size);


//
//            die();
            return $this->render('commonsizes',[
                'size' => $size,
                'sz' => $sz,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     * Overall stat of location distribution of products and sells
     *
     * */

    public function actionRest()
    {
        if(Yii::$app->user->can('statistics')) {

//            $pr = Product::find()
//                ->select(['location_id, COUNT(*) AS cnt'])
//                ->where(['status_id' => 1])
//                ->groupBy('location_id')
//                ->asArray()->all();
////            echo "<br/><br/><br/>";
//
//            $pract = ProductAction::find()
//                ->select(['location_id, COUNT(*) AS cnt'])
//                ->where(['status_id' => 2])//продано
//                ->groupBy('location_id')
//                ->asArray()->all();
//            var_dump($pract);
            return $this->render('rest',[
//                'pr' => $pr,
//                'pract' => $pract,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }



    /*
     * CRUD for Card Model
     *
     * */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


}
