<?php

namespace app\modules\room\controllers;

use app\models\Category;
use app\models\FilterGroup;
use app\models\Filter;
use app\models\Manufacturer;
use app\models\ModelToCategory;
use app\models\ModelToFilter;
use app\models\ModelToImage;
use app\models\Product;
use app\models\ProductAction;
use app\models\Profile;
use app\models\ProfileSearch;
use app\models\SearchForm;
use app\models\State;
use app\models\Size;
use Yii;
use yii\validators;
use app\models\ProductModel;
use yii\helpers\Url;
use mdm\admin\components\MenuHelper;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;



use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class AdminController extends \yii\web\Controller
{
    const API_URL = 'http://bank-ua.com/export/currrate.xml';
    const API_NBU = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=USD';//?valcode=EUR&date=YYYYMMDD

    /*
     * Get currency exchange rate by date from NBU
     * @input  date in format YYYYMMDD
     * @return double
     * */
    public function actionNbubydate($date)
    {
//        $settings = new State();
        $var = [];
        $request = self::API_NBU . '&date=' . http_build_query(
                [
                    'date'    => $date,
//                    'text' => Html::encode($text),
//                    'format' => 'html',
                ]
            );

        $response = file_get_contents(self::API_NBU.'&date='.$date);//$request)
//        var_dump($response);
        //load the xml string using simplexml function
        $xml = simplexml_load_string($response);
//        var_dump($xml->currency);
        //loop through the each node of molecule
        return $xml->currency->rate;
//        foreach ($xml->currency as $record) {
//            var_dump($record->rate);
//            echo $record->rate;
//////            //attribute are accessted by
////////            echo $record['name'], '  ';
//////            //node are accessted by -> operator
////////            switch ($record->char3) {
////////                case 'CNY':
////////                    echo $record->char3, '  ';
//////////                    echo $record->size, '  ';
////////                    echo $record->rate, '  ';
////////                    $var[strval($record->char3)] = strval($record->rate);
////////                    $cur = $settings->findOne($record->char3);
////////                    $cur->value = strval($record->rate);
////////                    $cur->save();
////////            }
//        }
    }

    /*
     *
     * */
    public function actionCurrency()
    {
        $settings = new State();
        $var = [];
//        $request = self::API_URL . '?' . http_build_query(
//                [
////                    'key' => $this->key,
////                    'lang' => $lang,
////                    'text' => Html::encode($text),
//                    'format' => 'html',
//                ]
//            );

        $response = file_get_contents(self::API_URL);
        //load the xml string using simplexml function
        $xml = simplexml_load_string($response);

        //loop through the each node of molecule
        foreach ($xml->item as $record)
        {
            //attribute are accessted by
//            echo $record['name'], '  ';
            //node are accessted by -> operator
            switch ($record->char3){
                case 'CNY':
//                    echo $record->char3, '  ';
////                    echo $record->size, '  ';
//                    echo $record->rate, '  ';
                    $var[strval($record->char3)] = strval($record->rate);
                    $cur = $settings->findOne($record->char3);
                    $cur->value = strval($record->rate);
                    $cur->save();
                    break;
                case 'EUR':
//                    echo $record->char3, '  ';
////                    echo $record->size, '  ';
//                    echo $record->rate, '  ';
                    $var[strval($record->char3)] = strval($record->rate);
                    $cur = $settings->findOne($record->char3);
                    $cur->value = strval($record->rate);
                    $cur->save();
                    break;
                case 'USD':
//                    echo $record->char3, '  ';
////                    echo $record->size, '  ';
//                    echo $record->rate, '  ';
                    $var[strval($record->char3)] = strval($record->rate);
                    $var['date'] = strval($record->date);
                    $cur = $settings->findOne($record->char3);
                    $cur->value = strval($record->rate);
                    $cur->save();
                    break;

            }
//            echo $record->char3, '  ';
//            echo $record->size, '  ';
//            echo $record->rate, '  ';
//            echo $record->name, '<br />';
        }
//        var_dump($var);
//        die();
//        return $this->render('currency',['var' => $var]);
        return $var;
    }

    /*
     *
     * */

    public function actionIndex()
    {
        if(Yii::$app->user->can('admin')) {
            return $this->render('index');
        }
        else
            throw new ForbiddenHttpException;
    }

    /*
     *
     *
     * */

    public function actionRfidupdate()
    {
        if(Yii::$app->user->can('admin')) {
            $model = new SearchForm();

            if($model->load(Yii::$app->request->post()) ){

                echo "nnnnn<br/>";
                $file = UploadedFile::getInstance($model, 'file');
                $file->saveAs('update/RFID_WIFI.ino.nodemcu.bin');
//                var_dump($file);
//                die();

                $rfid_update = State::find()->where(['param' => 'rfid_update'])->one();
                $rfid_update["value"] = "1";
                $rfid_update->save();

                Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Файл успішно завантажений!'));

            }
            return $this->render('rfidupdate',[
                'model' => $model,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }


    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionProfile()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionProfileview($id)
    {
        return $this->render('profileview', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Activate Capture mode due to associate RFID UID and user Id.
     * @param integer $id
     * @return mixed
     */
    public function actionSetcapture($id)
    {
        if(Yii::$app->user->can('admin')) {

            $settings = State::find()->where(['param' => 'uid_capture'])->one();
            $settings["value"] = $id;
            $settings->save();
//            var_dump($settings);
//            die();
//            $settings->value =

            return $this->redirect('profileview?id='.$id );
        }
        else
            throw new ForbiddenHttpException;
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionProfilecreate()
    {
        $model = new Profile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('profilecreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionProfileupdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->user_id]);
        } else {
            return $this->render('profileupdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
