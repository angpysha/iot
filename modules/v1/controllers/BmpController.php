<?php
/**
 * Created by PhpStorm.
 * User: andre
 * Date: 02.03.2018
 * Time: 22:21
 */

namespace app\modules\v1\controllers;


use yii\web\Controller;
use app\modules\v1\models\Bmp180;
use app\modules\v1\models\BmpSearch;
use app\modules\v1\models\CriticalValues;
use yii\helpers\Json;
use yii\web\Response;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use yii\filters\AccessControl;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\VerbFilter;

class BmpController extends Controller implements ISensorController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','last'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['reset'],
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
//        return ArrayHelper::merge(parent::behaviors(), [
////            'authenticator' => [
////                'class' => CompositeAuth::className(),
////                'authMethods' => [
////                    ['class' => HttpBearerAuth::className()],
////                    ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
////                ]
////            ],
////            'exceptionFilter' => [
////                'class' => ErrorToExceptionFilter::className()
////            ],
//            'access' => [
//                'class' => 'yii\filters\AccessControl',
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['create', 'update','last'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'last' => ['post'],
//                ],
//            ],
//        ]);
    }

    public function actionIndex()
    {
        $query = Bmp180::find();

        $pagination = new Pagination(['defaultPageSize' => 15,
            'totalCount' => $query->count(),
        ]);
        $bmps = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index',[
            'bmps' => $bmps,
            'pagination' => $pagination
        ]);
    }
//    public function behaviors()
//    {
//        return ['access' => [
//            'class' => AccessControl::className(),
//            'rules' => [
//                [
//                    'allow' => true,
//                    'actions' => ['login', 'signup','add','search','update'
//                        ,'delete','last','get','datecount','first','firstlastdates','','index'],
//                    'roles' => ['?'],
//                ]
//            ]
//        ]];
//    }
    public $enableCsrfValidation = false;
    public function actionTest()
    {
        var_dump("zzzzz");
    }

    /**
     * @SWG\Post(path="/api/v1/bmps/add",
     *     tags={"Bmp180"},
     *     summary="Add bmp data",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "BMP180 data",
     *        required = true,
     *         @SWG\Schema(ref="#/definitions/Bmp180")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionAdd()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(\Yii::$app->request->getRawBody());
        $bmp = new Bmp180();
        $bmp->Temperature = $data["Temperature"];
        $bmp->Altitude = $data["Altitude"];
        $bmp->Pressure = $data["Pressure"];
        if ($data["Created_at"])
            $bmp->Created_at = date("Y-m-d H:i:s", strtotime($data["Created_at"]));
        else
            $bmp->Created_at = date("Y-m-d H:i:s",time());
        if ($data["Updated_at"])
            $bmp->Updated_at = date("Y-m-d H:i:s", strtotime($data["Updated_at"]));
        else
            $bmp->Updated_at = date("Y-m-d H:i:s",time());
        $op_result = $bmp->save();
        if ($bmp->Pressure > CriticalValues::$maxPressure || $bmp->Pressure < CriticalValues::$minPressure)
        {
            $client = new Client(new Version2X('https://raspi-info-bot.herokuapp.com'));

            $client->initialize();
            $client->emit('critical',['param' => 'pressure']);
            $client->close();
        }
        $res["result"] = $op_result;
        $result = Json::encode($res);
        \Yii::$app->response->content = $result;
    }

    /**
     * @SWG\Put(path="/api/v1/bmps/update/{id}",
     *     tags={"Bmp180"},
     *     summary="Update bmp data",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "BMP180 data",
     *        required = true,
     *         @SWG\Schema(ref="#/definitions/Bmp180")
     *     ),
     *     @SWG\Parameter(
     *         ref="#/parameters/entity_id"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    function actionUpdate($id) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(\Yii::$app->request->getRawBody());
        $changed = false;
        $bmp = Bmp180::findOne($id);

        if ($data["Temperature"] != $bmp->Temperature)
        {
            $bmp->Temperature = $data["Temperature"];
            $changed = true;
        }

        if ($data["Pressure"] != $bmp->Pressure)
        {
            $bmp->Pressure = $data["Pressure"];
            $changed = true;
        }

        if ($data["Altitude"] != $bmp->Altitude)
        {
            $bmp->Altitude = $data["Altitude"];
            $changed = true;
        }

        if ($changed) {
            $op_result = $bmp->save();

            $res["result"] = $op_result;
            $result = Json::encode($res);
            \Yii::$app->response->content = $result;
        } else {
            $res["result"] = false;
            $result = Json::encode($res);
            \Yii::$app->response->content = $result;
        }
    }

    /**
     * @SWG\Delete(path="/api/v1/bmps/delete/{id}",
     *     tags={"Bmp180"},
     *     summary="Delete bmp data",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *         ref="#/parameters/entity_id"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/DhtData")
     *     ),
     * )
     */
    public function actionDelete($id) {

        $bmp = Bmp180::findOne($id);
        $op_result = $bmp->delete();
        $res["result"] = $op_result;
        $result = Json::encode($res);
        \Yii::$app->response->content = $result;
        //var_dump($id);
    }


    /**
     * @SWG\Post(path="/api/v1/bmps/search",
     *     tags={"Bmp180"},
     *     summary="Search bmp data",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *       @SWG\Parameter(
     *        in = "body",
     *        name = "body",
     *        description = "Search filter",
     *        required = true,
     *         @SWG\Schema(ref="#/definitions/BmpSearch")
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionSearch() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(\Yii::$app->request->getRawBody());
        //var_dump($data);
        $filter = new BmpSearch($data);
        $records = Bmp180::find();
        if ($filter->beginDate)
            $records = $records->andWhere(['>=','Created_at',$filter->beginDate]);

        if ($filter->endDate)
            $records = $records->andWhere(['<=','Created_at',$filter->endDate]);


        if ($filter->beginTemperature)
            $records = $records->andWhere(['>=','Temperature',$filter->beginTemperature]);

        if ($filter->endTemperature)
            $records = $records->andWhere(['<=','Temperature',$filter->endTemperature]);

        if ($filter->beginPressure)
            $records = $records->andWhere(['>=','Pressure',$filter->beginPressure]);

        if ($filter->endPressure)
            $records = $records->andWhere(['<=','Pressure',$filter->endPressure]);

        if ($filter->beginAltitude)
            $records = $records->andWhere(['>=','Altitude',$filter->beginAltitude]);

        if ($filter->endAltitude)
            $records = $records->andWhere(['<=','Altitude',$filter->endAltitude]);


        $records = $records->asArray()->all();

        header('Content-type:application/json');
        $json = JSON::encode($records);

        \Yii::$app->response->content =$json;
    }


    /**
     * @SWG\Post(path="/api/v1/bmps/get/{id}",
     *     tags={"Bmp180"},
     *     summary="Get bmp data",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *     in = "path",
     *     name = "id",
     *     description = "Entry id",
     *     required = true,
     *     type="integer"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionGet($id) {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $bmp = Bmp180::findOne($id);
        $json = JSON::encode($bmp);

        \Yii::$app->response->content =$json;
    }

    /**
     * @SWG\Post(path="/api/v1/bmps/last",
     *     tags={"Bmp180"},
     *     summary="Get last bmp entry",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionLast() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(\Yii::$app->request->getRawBody());
        if ($data) {
            $filter = new BmpSearch($data);
            $records = Bmp180::find();
            if ($filter->beginDate)
                $records = $records->andWhere(['>=','Created_at',$filter->beginDate]);

            if ($filter->endDate)
                $records = $records->andWhere(['<=','Created_at',$filter->endDate]);

            $records = $records->asArray()->orderBy('Created_at DESC')->all();
            $max = $records[0];
            $json = JSON::encode($max);
        } else {
            $max = Bmp180::find()->max('id');
            $bmp = Bmp180::findOne($max);
            $json = JSON::encode($bmp);
        }
        \Yii::$app->response->content = $json;
    }

    /**
     * @SWG\Post(path="/api/v1/bmps/first",
     *     tags={"Bmp180"},
     *     summary="Get first bmp entry",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionFirst() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Json::decode(\Yii::$app->request->getRawBody());
        if ($data) {
            $filter = new BmpSearch($data);
            $records = Bmp180::find();
            if ($filter->beginDate)
                $records = $records->andWhere(['>=','Created_at',$filter->beginDate]);

            if ($filter->endDate)
                $records = $records->andWhere(['<=','Created_at',$filter->endDate]);

            $records = $records->asArray()->orderBy('Created_at')->all();
            $max = $records[0];
            $json = JSON::encode($max);
        } else {
            $max = Bmp180::find()->min('id');
            $bmp = Bmp180::findOne($max);
            $json = JSON::encode($bmp);
        }
        \Yii::$app->response->content = $json;
    }

    /**
     * @SWG\Post(path="/api/v1/bmps/firstlastdates",
     *     tags={"Bmp180"},
     *     summary="Get corner dates",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionFirstlastdates() {
        $min = Bmp180::find()->min('id');
        $bmp_min = Bmp180::findOne($min);
        $max = Bmp180::find()->max('id');
        $bmp_max = Bmp180::findOne($max);

        $res["min"] = $bmp_min->Created_at;
        $res["max"] = $bmp_max->Created_at;

        return JSON::encode($res);

    }

    /**
     * @SWG\Post(path="/api/v1/bmps/datecount",
     *     tags={"Bmp180"},
     *     summary="Get dates count",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Response(
     *         response = 200,
     *         description = "User collection response",
     *         @SWG\Schema(ref = "#/definitions/Bmp180")
     *     ),
     * )
     */
    public function actionDatecount() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $min = (new \yii\db\Query())->select('*')
            ->from('Bmp180')
            ->orderBy('Created_at')
            ->limit('1')
            ->all()[0]['Created_at'];

        $max=(new \yii\db\Query())->select('*')
            ->from('Bmp180')
            ->orderBy('Created_at DESC')
            ->limit('1')
            ->all()[0]['Created_at'];
//        $res['min'] = $min;
//        $res['max'] = $max;
        $date1 = new \DateTime(date('Y-m-d',strtotime($min)));
        $date2 = new \DateTime(date('Y-m-d',strtotime($max)));
        $diff = $date1->diff($date2)->days;
        $result["pages"] = $diff;
        \Yii::$app->response->content = Json::encode($result);
//        var_dump($diff);
    }



    public function actionSendevent() {
        $client = new Client(new Version2X('http://127.0.0.1:3000'));

        $client->initialize();
        $client->emit('test',['foo' => 'bar']);
        $client->close();
    }
}