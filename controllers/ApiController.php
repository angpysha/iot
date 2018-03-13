<?php

namespace app\controllers;

use app\models\Location;
use app\models\State;
use app\models\TimeSheet;
use Yii;
use app\models\Profile;
use yii\web\Response;
use app\models\ProductAction;
use app\models\ProductActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductactionController implements the CRUD actions for ProductAction model.
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductAction models.
     * @return mixed
     */
    public function actionIndex()
    {

        return $this->render('index', [
        ]);
    }

    /**
     * Process request for RFID auth.
     * @param string esp
     * @return mixed
     */
    public function actionUid($esp, $uid)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if(isset($esp) && isset($uid)){
            $status = 0;
            $url = "";
            $set1 = State::find()->where(['param' => 'rfid_capture'])->one();
            $set2 = State::find()->where(['param' => 'uid_capture'])->one();
            $set3 = State::find()->where(['param' => 'rfid_update'])->one();
            if($set1["value"] == "0" && $set2["value"] == "0" && $set3["value"] == "0"){//
                $location = Location::find()->where(['rfid_id' => $esp])->one();
                $location_id = $location["location_id"];

                $user = \app\models\Profile::find()->where(['uid' => $uid])->one();
                $user_id = $user["user_id"];

//                $tsheet = TimeSheet::find()
//                    ->where(['user_id' => $user_id, 'location_id' => $location_id])
//                    ->andWhere(['like', 'time_start', date('Y-m-d', time())])
//                    ->andWhere(['like', 'time_finish', "0000-00-00"])
////                ->orderBy('time_start')
//                    ->one();

                // Check Assignment of location to RFID_id and user to uid
                if(isset($location_id) && isset($user_id)){
                    $str = "Hello";
                    echo sha1($str);

//                    if(isset($tsheet)){
//                        $ts = TimeSheet::findOne((int)$tsheet->id);
//                        $ts->time_finish = date('Y-m-d H:i:s', time());
//                        $ts->save();
//                        $status = 202;
//                    } else {
                        $tt = new TimeSheet();
                        $tt->user_id = $user_id;
                        $tt->location_id = $location_id;
                        $tt->save();
                        $status = 201;
//                    }
                }else{
                    if(!isset($location_id))
                        $status = 401; // Location unknown
                    if(!isset($user_id))
                        $status = 402; // User unknown
                    if(!isset($user_id) && !isset($location_id))
                        $status = 403; // Location and User unknown
                }
            }
            else{ // Capture Proccessing
                //Check if RFID_id already assigned, if true than erase this record
                $status = 200;
                $user_id = 0;
                $location_id = $set1["value"];
                if($set1["value"] != "0"){
                    //Clear RFID_id if it is assigned to another location
                    $location = Location::find()->where(['rfid_id' => $esp])->one();
                    if(strlen($location["rfid_id"])>0){
                        $location["rfid_id"] = '';
                        $location->save();
                    }
                    //New assignment
                    $location = Location::find()->where(['location_id' => $set1["value"]])->one();
                    $location["rfid_id"] = $esp;
                    $location->save();

//                    $location = Location::find()->where(['rfid_id' => $esp])->one();
//                    var_dump($location);
                    //Deactivate assigment for RFID_id
                    $set1["value"] = "0";
                    $set1->save();
                }
                //Check if uid_id already assigned, if true than erase this record
                if($set2["value"] != "0"){
                    $profile = Profile::find()->where(['uid' => $uid])->one();
                    if(strlen($profile["uid"])>0){
                        $profile["uid"] = '';
                        $profile->save();
                    }
                    //New assignment
                    $profile = Profile::find()->where(['user_id' => $set2["value"]])->one();
                    $profile["uid"] = $uid;
                    $profile->save();

                    //Deactivate assigment for uid
                    $set2["value"] = "0";
                    $set2->save();
                }
                //Check if upgrate function is activated
                if($set3["value"] != "0"){
                    //Deactivate upgrade function
                    $set3["value"] = "0";
                    $set3->save();

                    $status = 203;
                    $url = "http://iot.kpi.ua/web/update/RFID_WIFI.ino.nodemcu.bin";
                }

            }

            $var = [
                'esp' => $esp,
                'uid' => $uid,
                'user_id' => $user_id,
                'location_id' => $location_id,
                'file_bin' => $url,
                'status' => $status,
            ];

            return $var;
        }
    }

    private function xor_this($string) {

        // Let's define our key here
        $key = ('magic_key');

        // Our plaintext/ciphertext
        $text = $string;

        // Our output text
        $outText = '';

        // Iterate through each character
        for($i=0; $i<strlen($text); )
        {
            for($j=0; ($j<strlen($key) && $i<strlen($text)); $j++,$i++)
            {
                $outText .= $text{$i} ^ $key{$j};
                echo 'i=' . $i . ', ' . 'j=' . $j . ', ' . $outText{$i} . '<br />'; // For debugging
            }
        }
        return $outText;
    }

    /**
     * Displays a single ProductAction model.
     * @param integer $id
     * @return mixed
     */
    public function actionActionview($id)
    {
        return $this->render('actionview', [
            'model' => $this->findActionModel($id),
        ]);
    }

    /**
     * Creates a new ProductAction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductAction();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ProductAction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findActionModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ProductAction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findActionModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductAction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductAction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findActionModel($id)
    {
        if (($model = ProductAction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
